<div class="relative inline-block text-left notranslate" id="lang-switcher">
    <button type="button" onclick="toggleLangDropdown(event)" class="inline-flex justify-center items-center gap-2 rounded-xl bg-gray-50 border border-gray-200 px-3 py-1.5 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-100 transition-colors" id="menu-button" aria-expanded="false" aria-haspopup="true">
        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
        <span id="current-lang-name">English</span>
        <svg class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
        </svg>
    </button>
    <div class="absolute right-0 z-50 mt-2 w-44 origin-top-right rounded-xl bg-white shadow-xl ring-1 ring-black/5 focus:outline-none transition-all duration-200 hidden" id="lang-dropdown" role="menu">
        <div class="py-1.5 p-1" role="none">
            <a href="javascript:void(0)" onclick="setLanguage('en')" class="text-gray-700 hover:bg-blue-50 hover:text-blue-600 block px-3 py-2 rounded-lg text-sm font-medium transition-colors" role="menuitem">🇬🇧 English</a>
            <a href="javascript:void(0)" onclick="setLanguage('am')" class="text-gray-700 hover:bg-blue-50 hover:text-blue-600 block px-3 py-2 rounded-lg text-sm font-medium transition-colors" role="menuitem">🇪🇹 አማርኛ (Amharic)</a>
            <a href="javascript:void(0)" onclick="setLanguage('om')" class="text-gray-700 hover:bg-blue-50 hover:text-blue-600 block px-3 py-2 rounded-lg text-sm font-medium transition-colors" role="menuitem">🇪🇹 Oromoo (Oromo)</a>
            <a href="javascript:void(0)" onclick="setLanguage('so')" class="text-gray-700 hover:bg-blue-50 hover:text-blue-600 block px-3 py-2 rounded-lg text-sm font-medium transition-colors" role="menuitem">🇸🇴 Soomaali (Somali)</a>
        </div>
    </div>
</div>

<div id="google_translate_element" style="display:none;"></div>

<style>
    /* Hide the google translate toolbar and elements */
    .goog-te-banner-frame.skiptranslate { display: none !important; }
    body { top: 0px !important; }
    .goog-tooltip { display: none !important; }
    .goog-tooltip:hover { display: none !important; }
    .goog-text-highlight { background-color: transparent !important; border: none !important; box-shadow: none !important; }
</style>

<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'en',
            includedLanguages: 'en,am,om,so',
            autoDisplay: false
        }, 'google_translate_element');
    }
</script>
<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<script>
    function toggleLangDropdown(event) {
        event.stopPropagation();
        const dropdown = document.getElementById('lang-dropdown');
        if (dropdown) dropdown.classList.toggle('hidden');
    }

    function setLanguage(lang) {
        // Set Google Translate cookie
        document.cookie = "googtrans=/en/" + lang + "; path=/";
        document.cookie = "googtrans=/en/" + lang + "; domain=." + document.domain + "; path=/";
        localStorage.setItem('preferred-lang', lang);
        
        // Sync with backend
        const formData = new FormData();
        formData.append('locale', lang);
        formData.append('_token', '{{ csrf_token() }}');
        
        fetch('/language/switch', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
            },
            body: formData
        })
        .finally(() => {
            location.reload();
        });
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const dropdown = document.getElementById('lang-dropdown');
        const switcher = document.getElementById('lang-switcher');
        if (dropdown && switcher && !switcher.contains(event.target)) {
            dropdown.classList.add('hidden');
        }
    });

    // Update the UI label based on current language
    window.addEventListener('DOMContentLoaded', () => {
        const savedLang = localStorage.getItem('preferred-lang') || 'en';
        const langNames = {
            en: 'English',
            am: 'አማርኛ',
            om: 'Oromoo',
            so: 'Soomaali'
        };
        const currentLangSpan = document.getElementById('current-lang-name');
        if (currentLangSpan) {
            currentLangSpan.innerText = langNames[savedLang] || 'English';
        }
    });
</script>
