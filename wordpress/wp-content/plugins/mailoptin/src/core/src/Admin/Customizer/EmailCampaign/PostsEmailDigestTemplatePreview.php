<?php

namespace MailOptin\Core\Admin\Customizer\EmailCampaign;


use MailOptin\Core\EmailCampaigns\PostsEmailDigest\Templatify;
use MailOptin\Core\Repositories\EmailCampaignRepository;

class PostsEmailDigestTemplatePreview extends Templatify
{
    public function __construct($email_campaign_id, array $posts = [])
    {
        parent::__construct($email_campaign_id, $this->post_collection($email_campaign_id));
    }

    public function post_collection($email_campaign_id)
    {
        $item_count = EmailCampaignRepository::get_merged_customizer_value($email_campaign_id, 'item_number');

        $parameters = $default_params = [
            'posts_per_page' => $item_count,
            'post_status'    => 'publish',
            'post_type'      => 'post',
            'order'          => 'DESC',
            'orderby'        => 'post_date'
        ];

        $custom_post_type = EmailCampaignRepository::get_merged_customizer_value($email_campaign_id, 'custom_post_type');

        if ($custom_post_type != 'post') {
            $parameters['post_type'] = $custom_post_type;
        }

        $parameters = apply_filters('mo_post_digest_get_posts_args', $parameters, $email_campaign_id, 'customizer');

        $response = get_posts($parameters);

        if (empty($response)) {
            $response = get_posts($default_params);
        }

        return $response;
    }
}