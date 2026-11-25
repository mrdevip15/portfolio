<?php
// includes/tracking.php
// Google tag (GA4 + Google Ads). Include once inside <head>.
// Nothing is output until at least one ID below is filled in.

// GA4 Measurement ID, e.g. 'G-XXXXXXXXXX' (Google Analytics > Admin > Data streams)
const TRACKING_GA4_ID = '';
// Google Ads tag ID, e.g. 'AW-123456789' (Google Ads > Goals > Conversions > Tag setup)
const TRACKING_ADS_ID = '';
// Conversion labels from Google Ads (the part after the slash in 'AW-123456789/AbCdEf...')
const TRACKING_ADS_LABEL_WHATSAPP = '';
const TRACKING_ADS_LABEL_EMAIL = '';

if (TRACKING_GA4_ID === '' && TRACKING_ADS_ID === '') {
    return;
}
$tagIds = array_values(array_filter([TRACKING_GA4_ID, TRACKING_ADS_ID]));
?>
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo htmlspecialchars($tagIds[0]); ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
<?php foreach ($tagIds as $id): ?>
  gtag('config', <?php echo json_encode($id); ?>);
<?php endforeach; ?>

  // Count clicks on WhatsApp and email links as leads (GA4 event + Google Ads conversion).
  (function () {
    var adsId = <?php echo json_encode(TRACKING_ADS_ID); ?>;
    var labels = {
      whatsapp: <?php echo json_encode(TRACKING_ADS_LABEL_WHATSAPP); ?>,
      email: <?php echo json_encode(TRACKING_ADS_LABEL_EMAIL); ?>
    };
    document.addEventListener('click', function (e) {
      var a = e.target.closest && e.target.closest('a[href]');
      if (!a) return;
      var href = a.getAttribute('href') || '';
      var channel = /(^https?:\/\/)?(wa\.me|wa\.link|api\.whatsapp\.com|chat\.whatsapp\.com)\//i.test(href) ? 'whatsapp'
                  : /^mailto:/i.test(href) ? 'email' : null;
      if (!channel) return;
      gtag('event', 'generate_lead', {
        method: channel,
        link_text: (a.textContent || '').trim().slice(0, 100),
        page_path: location.pathname
      });
      if (adsId && labels[channel]) {
        gtag('event', 'conversion', { send_to: adsId + '/' + labels[channel] });
      }
    }, true);
  })();
</script>
