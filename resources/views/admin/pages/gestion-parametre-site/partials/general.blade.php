<div class="space-y-8">
    <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-2 h-full bg-purple-500"></div>
        <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2"><i class="fas fa-star text-purple-500"></i> Informations du site</h3>
        <div class="space-y-4">
            <div>
                <label for="site_name" class="block  text-xs font-bold text-slate-400 uppercase mb-1">Nom du site</label>
                <input type="text" id="site_name" name="site_name"   class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" value="{{ $generalSetting->site_name ?? '' }}">
            </div>
            <div>
                <label for="description" class="block text-xs font-bold text-slate-400 uppercase mb-1">Description</label>
                <textarea id="description" name="description" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-purple-500 outline-none" rows="2">{!! $generalSetting->description ?? '' !!}</textarea>
            </div>
            <div class="flex gap-4">
                <div class="flex-1">
                    <label for="footer_text" class="block text-xs font-bold text-slate-400 uppercase mb-1">Copyright</label>
                    <input type="text" id="footer_text" name="footer_text" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm" value="{{ $generalSetting->footer_text ?? '' }}">
                </div>
                {{-- <div class="flex-1">
                    <label class="block text-xs font-bold text-slate-400 uppercase mb-1">Lien Bouton</label>
                    <input type="text" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" value="#solutions">
                </div> --}}
            </div>
        </div>
    </div>

    <!-- About Section -->
    <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100">
        <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2"><i class="fas fa-info-circle text-blue-500"></i> Informations de contact</h3>
        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <label for="contact_email" class="block text-xs font-bold text-slate-400 uppercase mb-1">Adresse email</label>
                <input type="text" id="contact_email" name="contact_email" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold" value="{{ $generalSetting->contact_email ?? '' }}">
            </div>
            <div>
                <label for="contact_phone" class="block text-xs font-bold text-slate-400 uppercase mb-1">Contact</label>
                <input type="text" id="contact_phone" name="contact_phone" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold" value="{{ $generalSetting->contact_phone ?? '' }}">
            </div>

            {{-- <div class="grid grid-cols-3 gap-2">
                <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Années</label>
                    <input type="text" class="w-full p-2 bg-slate-50 border border-slate-200 rounded-lg text-center font-bold" value="15+">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Clients</label>
                    <input type="text" class="w-full p-2 bg-slate-50 border border-slate-200 rounded-lg text-center font-bold" value="500+">
                </div>
                <div>
                    <label class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Pays</label>
                    <input type="text" class="w-full p-2 bg-slate-50 border border-slate-200 rounded-lg text-center font-bold" value="12">
                </div>
            </div> --}}
        </div>
        <div class="mt-4">
            <label for="contact_address" class="block text-xs font-bold text-slate-400 uppercase mb-1">Adresse géographique</label>
            {{-- <textarea class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm h-32" rows="4">Depuis notre création, SONEC Africa s'est imposé comme le partenaire de confiance des entreprises et institutions qui souhaitent accélérer leur transformation numérique. Nous combinons expertise technologique et connaissance approfondie du marché africain.</textarea> --}}
            <input type="text" id="contact_address" name="contact_address" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold" value="{{ $generalSetting->contact_address ?? '' }}">
            
        </div>
    </div>

    {{-- Reseaux Sociaux --}}
    <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100">
        <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2"><i class="fas fa-share-alt text-green-500"></i> Réseaux sociaux</h3>
        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <label for="facebook_url" class="block text-xs font-bold text-slate-400 uppercase mb-1">Facebook</label>
                <input type="text" id="facebook_url" name="facebook_url" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-blue-500" value="{{ $generalSetting->facebook_url ?? '' }}">
            </div>
            <div>
                <label for="twitter_url" class="block text-xs font-bold text-slate-400 uppercase mb-1">Twitter</label>
                <input type="text" id="twitter_url" name="twitter_url" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-blue-400" value="{{ $generalSetting->twitter_url ?? '' }}">  
            </div>
            <div>
                <label for="instagram_url" class="block text-xs font-bold text-slate-400 uppercase mb-1">Instagram</label>
                <input type="text" id="instagram_url" name="instagram_url" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-pink-500" value="{{ $generalSetting->instagram_url ?? '' }}">
            </div>
            <div>
                <label for="linkedin_url" class="block text-xs font-bold text-slate-400 uppercase mb-1">LinkedIn</label>
                <input type="text" id="linkedin_url" name="linkedin_url" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-blue-700" value="{{ $generalSetting->linkedin_url ?? '' }}">
            </div>
        </div>
    </div>
</div>
