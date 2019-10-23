<?php

namespace MailOptin\MailjetConnect;

class Subscription extends AbstractMailjetConnect
{
    public $email;
    public $name;
    public $list_id;
    public $extras;

    public function __construct($email, $name, $list_id, $extras)
    {
        $this->email   = $email;
        $this->name    = $name;
        $this->list_id = $list_id;
        $this->extras  = $extras;

        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function subscribe()
    {
        try {

            $endpoint = "contactslist/{$this->list_id}/managecontact";

            $name_split = self::get_first_last_names($this->name);

            $firstname_key = $this->get_first_name_property();
            $lastname_key  = $this->get_last_name_property();

            $lead_data = [
                'Name'       => $this->name,
                'Email'      => $this->email,
                'Action'     => 'addforce', //The contact will be forcefully added to this list
                'Properties' => [
                    $firstname_key => $name_split[0],
                    $lastname_key  => $name_split[1]
                ],
            ];

            if (isset($this->extras['mo-acceptance']) && $this->extras['mo-acceptance'] == 'yes') {
                $gdpr_tag = apply_filters('mo_connections_mailjet_acceptance_tag', 'gdpr');
                try {
                    $this->mailjet_instance()->make_request('contactmetadata', [
                        'Datatype'  => 'str',
                        'Name'      => $gdpr_tag,
                        'NameSpace' => 'static'
                    ]);
                } catch (\Exception $e) {
                }

                $lead_data['Properties'][$gdpr_tag] = 'true';
            }

            //Add custom fields to the contact
            $custom_field_mappings = $this->form_custom_field_mappings();

            if ( ! empty($custom_field_mappings)) {

                foreach ($custom_field_mappings as $MailjetKey => $customFieldKey) {
                    // we are checking if $customFieldKey is not empty because if a merge field doesn't have a custom field
                    // selected for it, the default "Select..." value is empty ("")
                    if ( ! empty($customFieldKey) && ! empty($this->extras[$customFieldKey])) {
                        $value = $this->extras[$customFieldKey];
                        if (is_array($value)) {
                            $value = implode(', ', $value);
                        }
                        $lead_data['Properties'][$MailjetKey] = esc_attr($value);
                    }
                }
            }

            $lead_data['Properties'] = array_filter($lead_data['Properties'], [$this, 'data_filter']);

            $lead_data = array_filter($lead_data, [$this, 'data_filter']);

            //Create the subscriber(if not exists) then add them to the list
            $response = $this->mailjet_instance()->make_request($endpoint, $lead_data);

            //If the contact was successfully created, the response count will be 1
            if (isset($response->Count) && ! empty($response->Count)) {
                return parent::ajax_success();
            }

            self::save_optin_error_log(json_encode($response), 'mailjet', $this->extras['optin_campaign_id']);

            return parent::ajax_failure(__('There was an error saving your contact. Please try again.', 'mailoptin'));

        } catch (\Exception $e) {

            self::save_optin_error_log($e->getCode() . ': ' . $e->getMessage(), 'mailjet', $this->extras['optin_campaign_id']);

            return parent::ajax_failure(__('There was an error saving your contact. Please try again.', 'mailoptin'));
        }
    }
}