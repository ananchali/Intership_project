<div class="relative inline-block text-left notranslate" id="lang-switcher">
    <button type="button" onclick="toggleLangDropdown(event)" class="inline-flex justify-center items-center gap-2 rounded-xl bg-gray-50 border border-gray-200 px-3 py-1.5 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-100 transition-colors" id="menu-button" aria-expanded="false" aria-haspopup="true">
        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
        <span id="current-lang-name">English</span>
        <svg class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
        </svg>
    </button>

    <div class="absolute right-0 z-50 mt-2 w-52 origin-top-right rounded-xl bg-gray-50 border border-gray-200 shadow-xl focus:outline-none transition-all duration-200 hidden max-h-64 overflow-y-auto overscroll-contain" id="lang-dropdown" role="menu">
        <div class="p-2 sticky top-0 bg-gray-50 border-b border-gray-200 z-10 rounded-t-xl">
            <input type="text" id="lang-search" onkeyup="filterLanguages()" onclick="event.stopPropagation()" placeholder="Search language..." class="w-full px-3 py-1.5 text-sm border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-colors bg-white text-gray-700 placeholder-gray-400">
        </div>
        <div class="py-1.5 p-1" role="none" id="lang-list">
            <a href="javascript:void(0)" onclick="setLanguage('en')"  class="lang-option text-gray-700 hover:bg-gray-200 hover:text-blue-700 flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-colors" role="menuitem">🇬🇧 <span>English</span></a>
            <a href="javascript:void(0)" onclick="setLanguage('am')"  class="lang-option text-gray-700 hover:bg-gray-200 hover:text-blue-700 flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-colors" role="menuitem">🇪🇹 <span>አማርኛ (Amharic)</span></a>
            <a href="javascript:void(0)" onclick="setLanguage('om')"  class="lang-option text-gray-700 hover:bg-gray-200 hover:text-blue-700 flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-colors" role="menuitem">🇪🇹 <span>Oromoo (Oromo)</span></a>
            <a href="javascript:void(0)" onclick="setLanguage('ti')"  class="lang-option text-gray-700 hover:bg-gray-200 hover:text-blue-700 flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-colors" role="menuitem">🇪🇹 <span>ትግርኛ (Tigrinya)</span></a>
            <a href="javascript:void(0)" onclick="setLanguage('so')"  class="lang-option text-gray-700 hover:bg-gray-200 hover:text-blue-700 flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-colors" role="menuitem">🇸🇴 <span>Soomaali (Somali)</span></a>
            <a href="javascript:void(0)" onclick="setLanguage('sw')"  class="lang-option text-gray-700 hover:bg-gray-200 hover:text-blue-700 flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-colors" role="menuitem">🇰🇪 <span>Kiswahili (Swahili)</span></a>
            <a href="javascript:void(0)" onclick="setLanguage('ar')"  class="lang-option text-gray-700 hover:bg-gray-200 hover:text-blue-700 flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-colors" role="menuitem">🇸🇦 <span>العربية (Arabic)</span></a>
            <a href="javascript:void(0)" onclick="setLanguage('fr')"  class="lang-option text-gray-700 hover:bg-gray-200 hover:text-blue-700 flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-colors" role="menuitem">🇫🇷 <span>Français (French)</span></a>
            <a href="javascript:void(0)" onclick="setLanguage('ha')"  class="lang-option text-gray-700 hover:bg-gray-200 hover:text-blue-700 flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-colors" role="menuitem">🇳🇬 <span>Hausa</span></a>
            <a href="javascript:void(0)" onclick="setLanguage('yo')"  class="lang-option text-gray-700 hover:bg-gray-200 hover:text-blue-700 flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-colors" role="menuitem">🇳🇬 <span>Yorùbá (Yoruba)</span></a>
            <a href="javascript:void(0)" onclick="setLanguage('zu')"  class="lang-option text-gray-700 hover:bg-gray-200 hover:text-blue-700 flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-colors" role="menuitem">🇿🇦 <span>isiZulu (Zulu)</span></a>
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
    /* Scrollable dropdown */
    #lang-dropdown::-webkit-scrollbar { width: 6px; }
    #lang-dropdown::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 4px; }
    #lang-dropdown::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
</style>

<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({
            pageLanguage: 'en',
            includedLanguages: 'en,am,om,ti,so,sw,ar,fr,ha,yo,zu',
            autoDisplay: false
        }, 'google_translate_element');
    }
</script>
<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<script>
    const langNames = {
        en: '🇬🇧 English',
        am: '🇪🇹 አማርኛ',
        om: '🇪🇹 Oromoo',
        ti: '🇪🇹 ትግርኛ',
        so: '🇸🇴 Soomaali',
        sw: '🇰🇪 Kiswahili',
        ar: '🇸🇦 العربية',
        fr: '🇫🇷 Français',
        ha: '🇳🇬 Hausa',
        yo: '🇳🇬 Yorùbá',
        zu: '🇿🇦 isiZulu'
    };

    function toggleLangDropdown(event) {
        event.stopPropagation();
        const dropdown = document.getElementById('lang-dropdown');
        if (dropdown) {
            dropdown.classList.toggle('hidden');
            if (!dropdown.classList.contains('hidden')) {
                const searchInput = document.getElementById('lang-search');
                if (searchInput) {
                    searchInput.value = '';
                    filterLanguages(); // reset filter
                    setTimeout(() => searchInput.focus(), 50); // focus the search field
                }
            }
        }
    }

    function filterLanguages() {
        const input = document.getElementById('lang-search');
        const filter = input.value.toLowerCase();
        const nodes = document.querySelectorAll('.lang-option');
        
        nodes.forEach(node => {
            const text = node.innerText || node.textContent;
            if (text.toLowerCase().indexOf(filter) > -1) {
                // We use flex in class, so we reset display to empty so flex class applies or explicitly set to flex
                node.style.setProperty('display', 'flex', 'important');
            } else {
                node.style.setProperty('display', 'none', 'important');
            }
        });
    }

    function setLanguage(lang) {
        // Set Google Translate cookie
        document.cookie = "googtrans=/en/" + lang + "; path=/";
        document.cookie = "googtrans=/en/" + lang + "; domain=." + document.domain + "; path=/";
        localStorage.setItem('preferred-lang', lang);

        // Sync with backend session
        const formData = new FormData();
        formData.append('locale', lang);
        formData.append('_token', '{{ csrf_token() }}');

        fetch('/language/switch', {
            method: 'POST',
            headers: { 'Accept': 'application/json' },
            body: formData
        }).finally(() => {
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
        const currentLangSpan = document.getElementById('current-lang-name');
        if (currentLangSpan) {
            currentLangSpan.innerText = (langNames[savedLang] || 'English').replace(/^[\uD800-\uDFFF]{2}\s/, '');
        }
    });
</script>

