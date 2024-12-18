<div class="cf-turnstile" id="cf-turnstile" data-sitekey="{{ config('cloudflare.recaptcha.site_key') }}" data-callback="verifyCallback" data-theme="light"></div>
<script type="text/javascript">
    function verifyCallback () {
        document.querySelector('.recaptcha-submit-btn').removeAttribute('disabled');
    }
</script>
<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" defer></script>
