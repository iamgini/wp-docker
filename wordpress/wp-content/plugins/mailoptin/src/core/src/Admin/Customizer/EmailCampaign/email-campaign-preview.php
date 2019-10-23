<?php

namespace MailOptin\Core\Admin\Customizer\EmailCampaign;

use MailOptin\Core\Repositories\EmailCampaignRepository;

$email_campaign_id = absint($_REQUEST['mailoptin_email_campaign_id']);

$email_campaign_type = EmailCampaignRepository::get_email_campaign_type($email_campaign_id);

$email_campaign_type_namespace = EmailCampaignFactory::get_campaign_type_namespace($email_campaign_type);

$template_preview_class = "MailOptin\\Core\\Admin\\Customizer\\EmailCampaign\\{$email_campaign_type_namespace}TemplatePreview";

switch ($email_campaign_type) {
    case EmailCampaignRepository::NEW_PUBLISH_POST:
        /** @var NewPublishPostTemplatePreview $template_preview_instance */
        $template_preview_instance = new $template_preview_class($email_campaign_id, null);
        break;
    case EmailCampaignRepository::POSTS_EMAIL_DIGEST:
        /** @var PostsEmailDigestTemplatePreview $template_preview_instance */
        $template_preview_instance = new $template_preview_class($email_campaign_id);
        break;
    case EmailCampaignRepository::NEWSLETTER:
        /** @var NewsletterTemplatePreview $template_preview_instance */
        $template_preview_instance = new $template_preview_class($email_campaign_id);
        break;
}

if (EmailCampaignRepository::is_newsletter($email_campaign_id)) {
    ?>
    <style type="text/css">
        div#wp-mo_newsletter_editor-wrap {
            height: 100%;
            margin: 10px;
        }

        .media-modal .media-modal-content {
            height: calc(100% - 75px);
        }
    </style>
    <!--    hack to make add media view styled correctly -->
    <link rel="stylesheet" href="<?= wp_styles()->base_url; ?>/wp-admin/load-styles.php?c=1&dir=ltr&load%5B%5D=dashicons,buttons,common,forms" type="text/css" media="all">
    <?php
}

echo $template_preview_instance->forge();

// this is not in AbstractTemplate as in AbstractOptinForm so it doesn't get templatified/emogrified along with the email template
// on customizer preview.
// hide any element that might have been injected to footer by any plugin.
echo '<div style="display:none">';
wp_footer();
echo '</div>';