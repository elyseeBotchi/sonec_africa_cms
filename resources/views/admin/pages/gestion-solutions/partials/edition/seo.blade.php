<div class="space-y-8">
    <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100">
        <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2"><i class="fas fa-search text-yellow-500"></i> SEO & Méta</h3>
        <input type="hidden" name="seo_id" value="{{ $solution->seo->id ?? '' }}">
        <div class="mb-4">
            <div>
                <label for="seo_title" class="block text-xs font-bold text-slate-400 uppercase mb-1">Meta Title</label>
                <input type="text" id="seo_title" name="seo_title" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold" value="{!! $solution->seo->meta_title ?? '' !!}">
            </div>
            
        </div>
        <div class="mt-4">
            <label for="seo_keywords" class="block text-xs font-bold text-slate-400 uppercase mb-1">Meta Keywords (séparés par des virgules)</label>
            <textarea id="seo_keywords" name="seo_keywords" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" rows="3">{!! $solution->seo->meta_keywords ?? '' !!}</textarea>
        </div>
        <div class="mt-4">
            <label for="seo_description" class="block text-xs font-bold text-slate-400 uppercase mb-1">Meta Description</label>
            <textarea id="seo_description" name="seo_description" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm" rows="4" maxlength="160">{!! $solution->seo->meta_description ?? '' !!}</textarea>
            <p class="text-xs text-slate-400 mt-1">La meta description doit être concise et contenir les mots-clés principaux pour un meilleur référencement (160 caractères maximum).</p>
        </div>
        {{-- <input type="hidden" name="seo_page_key" value="decouvrir-sonec-africa"> --}}
    </div>
</div>