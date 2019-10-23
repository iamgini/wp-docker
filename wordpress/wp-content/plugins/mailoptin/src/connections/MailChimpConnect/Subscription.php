<?php

namespace MailOptin\MailChimpConnect;

class Subscription extends AbstractMailChimpConnect
{
    public $email;
    public $name;
    public $list_id;
    public $extras;
    protected $optin_campaign_id;
    /** @var Connect */
    protected $connectInstance;

    public function __construct($email, $name, $list_id, $extras, $connectInstance)
    {
        $this->email           = $email;
        $this->name            = $name;
        $this->list_id         = $list_id;
        $this->extras          = $extras;
        $this->connectInstance = $connectInstance;

        $this->optin_campaign_id = absint($this->extras['optin_campaign_id']);

        parent::__construct();
    }

    /**
     * True if double optin is not disabled.
     *
     * @return bool
     */
    public function is_double_optin()
    {
        $setting = $this->get_integration_data('MailChimpConnect_disable_double_optin');

        $val = $setting !== true;

        return apply_filters('mo_connections_mailchimp_is_double_optin', $val, $this->optin_campaign_id);
    }

    /**
     * Return array of selected interests.
     *
     * @return array
     */
    public function interests()
    {
        $segmentation_type = $this->get_integration_data('MailChimpConnect_group_segment_type');

        if ($segmentation_type == 'automatic') {
            $interests = array_keys($this->get_integration_data('MailChimpConnect_interests'));
        } else {
            $interests = isset($this->extras['mo-mailchimp-interests']) ? $this->extras['mo-mailchimp-interests'] : [];
        }

        if (empty($interests)) return [];

        $interests = array_map('sanitize_text_field', $interests);

        $interests = array_fill_keys($interests, true);

        return $interests;
    }

    public function update_gdpr_permission()
    {
        try {
            $request = $this->mc_list_instance()->getMembers($this->list_id, ['count' => 1, 'fields' => 'members.marketing_permissions.marketing_permission_id']);

            if (isset($request->members[0]->marketing_permissions)) {
                $permission_ids = array_reduce($request->members[0]->marketing_permissions, function ($carry, $item) {
                    $carry[] = $item->marketing_permission_id;

                    return $carry;
                });

                $parameters = ['marketing_permissions' => []];

                foreach ($permission_ids as $permission_id) {
                    $parameters['marketing_permissions'][] = [
                        'marketing_permission_id' => $permission_id,
                        'enabled'                 => true
                    ];
                }

                $this->mc_list_instance()->addOrUpdateMember($this->list_id, $this->email, $parameters);

            }
        } catch (\Exception $e) {
            // do nothing.
        }
    }

    /**
     * @return mixed
     */
    public function subscribe()
    {
        try {
            $name_split = self::get_first_last_names($this->name);

            $optin_status = $this->is_double_optin() ? 'pending' : 'subscribed';

            $firstname_key = $this->get_first_name_merge_tag();
            $lastname_key  = $this->get_last_name_merge_tag();

            $merge_fields = [
                $firstname_key => $name_split[0],
                $lastname_key  => $name_split[1]
            ];

            $custom_field_mappings = $this->form_custom_field_mappings();

            $list_merge_fields = $this->connectInstance->get_optin_fields($this->list_id);

            if (is_array($custom_field_mappings) && is_array($list_merge_fields)) {
                $intersect_result = array_intersect(array_keys($custom_field_mappings), array_keys($list_merge_fields));

                if ( ! empty($intersect_result) && ! empty($custom_field_mappings)) {
                    foreach ($custom_field_mappings as $mergeFieldKey => $customFieldKey) {
                        // we are checking if $customFieldKey is not empty because if a merge field doesnt have a custom field
                        // selected for it, the default "Select..." value is empty ("")
                        if ( ! empty($customFieldKey) && ! empty($this->extras[$customFieldKey])) {
                            $value = $this->extras[$customFieldKey];
                            if (is_array($value)) {
                                $value = implode(', ', $value);
                            }
                            $merge_fields[$mergeFieldKey] = esc_attr($value);
                        }
                    }
                }
            }

            $parameters = [
                'merge_fields'  => array_filter($merge_fields, [$this, 'data_filter']),
                'interests'     => $this->interests(),
                'status_if_new' => $optin_status,
                'ip_signup'     => \MailOptin\Core\get_ip_address()
            ];

            $lead_tags = $this->get_integration_data('MailChimpConnect_lead_tags');

            if ( ! empty($lead_tags)) {
                $parameters['tags'] = array_map('trim', explode(',', $lead_tags));
            }

            $parameters = apply_filters('mo_connections_mailchimp_subscription_parameters', array_filter($parameters, [$this, 'data_filter']), $this);

            $response = $this->mc_list_instance()->addOrUpdateMember($this->list_id, $this->email, $parameters);

            if (is_object($response) && in_array($response->status, ['subscribed', 'pending'])) {

                if (isset($this->extras['mo-acceptance']) && $this->extras['mo-acceptance'] == 'yes') {
                    $this->update_gdpr_permission();
                }

                return parent::ajax_success();
            }

            return parent::ajax_failure(__('There was an error saving your contact. Please try again.', 'mailoptin'));

        } catch (\Exception $e) {
            self::save_optin_error_log($e->getCode() . ': ' . $e->getMessage(), 'mailchimp', $this->extras['optin_campaign_id']);

            return parent::ajax_failure(__('There was an error saving your contact. Please try again.', 'mailoptin'));
        }
    }
}