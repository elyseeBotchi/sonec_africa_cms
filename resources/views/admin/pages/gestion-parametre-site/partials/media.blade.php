<div class="space-y-8">
    <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100">
        {{-- <form id="general-settings-form" enctype="multipart/form-data"> --}}
            <div class="grid md:grid-cols-2 gap-8">
                
                <div>
                    {{-- <label for="site_logo" class="block text-xs font-bold text-slate-400 uppercase mb-1">Changer le logo</label> --}}
                    <h3 class="text-lg font-bold text-sonec-dark mb-6">Logo du site (header)</h3>
                    <div class="preview-area-logo bg-slate-50 rounded-xl p-4 flex items-center justify-center border border-slate-200 border-dashed">
                        <div class="text-center ">
                            <input id="site_logo" type="file" class=" hidden w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold" accept="image/*" name="site_logo">
                            <i class="fas fa-image text-3xl text-slate-300 mb-2"></i>
                            <p class="text-xs text-slate-400 mb-2">Aperçu image logo</p>
                            <label for="site_logo" class="mt-2 text-xs bg-white px-3 py-1 rounded border hover:bg-slate-100 cursor-pointer">Changer</label>
                        </div>
                        
                    </div>
                    @if ($generalSetting->site_logo)
                        <div class="text-center mt-4 w-24 h-24 mx-auto">
                            <img src="{{ asset('/storage/' . $generalSetting->site_logo) }}" alt="Logo du footer" class="max-h-full max-w-full">
                        </div>
                    @endif
                </div>
                <div>
                    {{-- <label for="site_logo" class="block text-xs font-bold text-slate-400 uppercase mb-1">Changer le logo</label> --}}
                    <h3 class="text-lg font-bold text-sonec-dark mb-6">Logo du pied de page (footer)</h3>
                    {{-- recuper l'image du footer s'il existe --}}
                    <div class="preview-area-logo-footer bg-slate-50 rounded-xl p-4 flex items-center justify-center border border-slate-200 border-dashed">
                        <div class="text-center ">
                            <input id="logo_footer" type="file" class=" hidden w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold" accept="image/*" name="logo_footer">
                            <i class="fas fa-image text-3xl text-slate-300 mb-2"></i>
                            <p class="text-xs text-slate-400 mb-2">Aperçu image Logo du footer</p>
                            <label for="logo_footer" class="mt-2 text-xs bg-white px-3 py-1 rounded border hover:bg-slate-100 cursor-pointer">Changer</label>
                        </div>
                    </div>
                    @if ($generalSetting->logo_footer)
                        <div class="text-center mt-4 w-24 h-24 mx-auto">
                            <img src="{{ asset('/storage/' . $generalSetting->logo_footer) }}" alt="Logo du footer" class="max-h-full max-w-full">
                        </div>
                    @endif
                </div>
                <div>
                    {{-- <label for="site_logo" class="block text-xs font-bold text-slate-400 uppercase mb-1">Changer le logo</label> --}}
                    <h3 class="text-lg font-bold text-sonec-dark mb-6">Favicon du site</h3>
                    <div class="preview-area-favicon bg-slate-50 rounded-xl p-4 flex items-center justify-center border border-slate-200 border-dashed">
                        
                        <div class="text-center ">
                            <input id="site_favicon" type="file" class=" hidden w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold" accept="image/*" name="site_favicon">
                            <i class="fas fa-image text-3xl text-slate-300 mb-2"></i>
                            <p class="text-xs text-slate-400 mb-2">Aperçu image Favicon</p>
                            <label for="site_favicon" class="mt-2 text-xs bg-white px-3 py-1 rounded border hover:bg-slate-100 cursor-pointer">Changer</label>
                        </div>
                        
                    </div>

                    @if ($generalSetting->site_favicon)
                        <div class="text-center mt-4 w-24 h-24 mx-auto">
                            <img src="{{ asset('/storage/' . $generalSetting->site_favicon) }}" alt="Favicon du site" class="max-h-full max-w-full">
                        </div>
                    @endif
                </div>
            </div>
        {{-- </form> --}}
    </div>
</div>