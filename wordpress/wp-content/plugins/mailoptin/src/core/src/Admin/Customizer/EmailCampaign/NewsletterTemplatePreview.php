<?php

namespace MailOptin\Core\Admin\Customizer\EmailCampaign;


use MailOptin\Core\EmailCampaigns\Newsletter\Templatify;
use MailOptin\Core\Repositories\EmailCampaignRepository;

class NewsletterTemplatePreview extends Templatify
{
    public function newsletter_content()
    {
        $instance = EmailCampaignFactory::make($this->email_campaign_id);

        $preview_structure = $instance->get_preview_structure();

        $content = EmailCampaignRepository::get_customizer_value($this->email_campaign_id, 'newsletter_editor_content');

        if (isset($_GET['newsletterContent']) && $_GET['newsletterContent'] == 'true') {
            ob_start();
            wp_editor(
                $content,
                'mo_newsletter_editor',
                array(
                    'drag_drop_upload' => true,
                    'editor_height'    => 500,
                    'tinymce'          => array(
                        'resize'           => false,
                        'wp_autoresize_on' => true,
                        'toolbar1'         => 'formatselect,bold,italic,bullist,numlist,link,hr,alignleft,aligncenter,alignright,underline,wp_adv',
                        'toolbar2'         => 'fontsizeselect,strikethrough,forecolor,backcolor,pastetext,removeformat,charmap,outdent,indent,wp_help',
                        'fontsize_formats' => "10px 12px 14px 16px 18px 20px 24px 28px 30px 36px"
                    ),
                )
            );

            $tinymce_editor = ob_get_clean();

            return $tinymce_editor;
        }

        $search = ['{{newsletter.content}}'];

        $replace = [$content];

        return str_replace($search, $replace, $preview_structure);
    }
}