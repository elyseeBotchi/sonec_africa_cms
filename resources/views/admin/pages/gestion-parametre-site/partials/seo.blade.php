<div class="space-y-8">
    <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100">
        <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2"><i class="fas fa-search text-yellow-500"></i> SEO & Méta</h3>
        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <label for="meta_title" class="block text-xs font-bold text-slate-400 uppercase mb-1">Meta Title</label>
                <input type="text" id="meta_title" name="meta_title" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold" value="{!! $generalSetting->meta_title ?? '' !!}">
            </div>
            <div>
                <label for="meta_keywords" class="block text-xs font-bold text-slate-400 uppercase mb-1">Meta Keywords (séparés par des virgules)</label>
                <textarea id="meta_keywords" name="meta_keywords" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" rows="3">{!! $generalSetting->meta_keywords ?? '' !!}</textarea>
            </div>
        </div>
        <div class="mt-4">
            <label for="meta_description" class="block text-xs font-bold text-slate-400 uppercase mb-1">Meta Description</label>
            <textarea id="meta_description" name="meta_description" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm" rows="4" maxlength="160">{!! $generalSetting->meta_description ?? '' !!}</textarea>
            <p class="text-xs text-slate-400 mt-1">La meta description doit être concise et contenir les mots-clés principaux pour un meilleur référencement (160 caractères maximum).</p>
        </div>
    </div>
</div>