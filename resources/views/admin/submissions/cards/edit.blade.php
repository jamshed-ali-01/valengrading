@extends('layouts.admin')

@section('title', 'Edit Card: ' . $card->title)

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.submissions.show', $card->submission_id) }}" class="text-gray-400 hover:text-white flex items-center gap-2 transition-colors group">
            <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            <span class="font-medium">Back to Submission Details</span>
        </a>
        <div class="flex items-center gap-3">
            <span class="text-xs text-gray-500 uppercase tracking-widest font-bold">Submission No:</span>
            <span class="text-red-500 font-bold bg-red-500/10 px-3 py-1 rounded-lg border border-red-500/20">{{ $card->submission->submission_no }}</span>
        </div>
    </div>

    <div class="space-y-6">
        <!-- Top Header: Card Context -->
        <div class="bg-gradient-to-br from-[#232528] to-[#1a1c1e] backdrop-blur-xl border border-white/5 rounded-2xl p-6 shadow-2xl relative overflow-hidden group">
            <div class="absolute top-0 right-0 w-64 h-64 bg-red-500/5 rounded-full blur-3xl -mr-32 -mt-32 group-hover:bg-red-500/10 transition-colors duration-700"></div>
            
            <div class="relative flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-red-500/10 border border-red-500/20 flex items-center justify-center">
                            <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <h4 class="text-xs font-bold text-gray-500 uppercase tracking-widest leading-none mb-1">Editing Card</h4>
                            <p class="text-white font-bold text-2xl leading-tight">{{ $card->title }}</p>
                        </div>
                    </div>

                    <div class="flex flex-wrap items-center gap-4 text-sm">
                        <div class="flex items-center gap-2 bg-white/5 px-3 py-1.5 rounded-lg border border-white/5">
                            <span class="text-gray-500 font-bold uppercase text-[10px] tracking-wider">Year:</span>
                            <span class="text-gray-200 font-medium">{{ $card->year ?: '-' }}</span>
                        </div>
                        <div class="flex items-center gap-2 bg-white/5 px-3 py-1.5 rounded-lg border border-white/5">
                            <span class="text-gray-500 font-bold uppercase text-[10px] tracking-wider">Set:</span>
                            <span class="text-gray-200 font-medium truncate max-w-[200px]" title="{{ $card->set_name }}">{{ $card->set_name ?: '-' }}</span>
                        </div>
                        <div class="flex items-center gap-2 bg-white/5 px-3 py-1.5 rounded-lg border border-white/5">
                            <span class="text-gray-500 font-bold uppercase text-[10px] tracking-wider">Number:</span>
                            <span class="text-gray-200 font-medium">#{{ $card->card_number ?: '-' }}</span>
                        </div>
                        <div class="flex items-center gap-2 bg-white/5 px-3 py-1.5 rounded-lg border border-white/5">
                            <span class="text-gray-500 font-bold uppercase text-[10px] tracking-wider">Lang:</span>
                            <span class="text-gray-200 font-medium">{{ strtoupper($card->lang ?? '-') }}</span>
                        </div>
                        <div class="flex items-center gap-2 bg-red-500/10 px-3 py-1.5 rounded-lg border border-red-500/20">
                            <span class="text-red-400 font-bold uppercase text-[10px] tracking-wider">Label:</span>
                            <span class="text-red-400 font-medium">{{ $card->labelType->name ?? 'Standard' }}</span>
                        </div>
                    </div>
                </div>

                @if($card->notes)
                    <div class="md:max-w-xs p-4 bg-white/5 rounded-xl border border-white/5 relative">
                        <div class="absolute top-0 right-0 p-2 opacity-20">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21L14.017 18C14.017 16.8954 13.1216 16 12.017 16H9.01703C7.91246 16 7.01703 16.8954 7.01703 18V21H5.01703V18C5.01703 15.7909 6.80789 14 9.01703 14H12.017C14.2262 14 16.017 15.7909 16.017 18V21H14.017ZM21.017 21L21.017 18C21.017 16.8954 20.1216 16 19.017 16H16.017C14.9125 16 14.017 16.8954 14.017 18V21H12.017V18C12.017 15.7909 13.8079 14 16.017 14H19.017C21.2262 14 23.017 15.7909 23.017 18V21H21.017Z"/></svg>
                        </div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Customer Notes</label>
                        <p class="text-sm text-gray-300 italic">"{{ $card->notes }}"</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Main Form Content -->
        <div class="bg-[#232528]/80 backdrop-blur-xl border border-white/5 rounded-2xl shadow-2xl overflow-hidden">
            <div class="p-8 border-b border-white/5 bg-white/2">
                <h3 class="text-xl font-bold text-white">Grading & Logistics</h3>
                <p class="text-gray-400 text-sm mt-1">Provide final grading details and update the current logistics status.</p>
            </div>

            <form action="{{ route('admin.submissions.cards.update', $card) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-10">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="space-y-4">
                        <label for="status" class="block text-sm font-bold text-gray-300 uppercase tracking-wider">Logistics Status</label>
                        <div class="relative group">
                            <select name="status" id="status" class="w-full bg-[#15171A] border border-white/10 rounded-xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition-colors appearance-none cursor-pointer group-hover:border-white/20">
                                @foreach($statuses as $status)
                                    <option value="{{ $status }}" {{ ($card->status ?? 'Submission Complete') === $status ? 'selected' : '' }}>{{ $status }}</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500">
                                <svg class="w-5 h-5 transition-transform group-hover:translate-y-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <label for="grade" class="block text-sm font-bold text-gray-300 uppercase tracking-wider">Final Grade</label>
                        <input type="text" name="grade" id="grade" value="{{ old('grade', $card->grade) }}" 
                            class="w-full bg-[#15171A] border border-white/10 rounded-xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition-all hover:border-white/20"
                            placeholder="e.g. Gem Mint 10">
                    </div>
                </div>

                <div class="space-y-6">
                    <label class="block text-sm font-bold text-gray-300 uppercase tracking-wider">Sub-Grades</label>
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach(['centering', 'corners', 'edges', 'surface'] as $subgrade)
                            <div class="bg-[#15171A] p-4 rounded-xl border border-white/5 space-y-3 hover:border-red-500/30 transition-colors">
                                <label for="{{ $subgrade }}" class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest">{{ $subgrade }}</label>
                                <input type="number" step="0.5" min="1" max="10" name="{{ $subgrade }}" id="{{ $subgrade }}" value="{{ old($subgrade, $card->$subgrade) }}" 
                                    class="w-full bg-transparent border-b border-white/10 p-0 text-2xl font-bold text-white focus:outline-none focus:border-red-500 transition-colors placeholder-gray-800"
                                    placeholder="0.0">
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="space-y-4">
                        <label for="grading_insights" class="block text-sm font-bold text-gray-300 uppercase tracking-wider">Grading Insights (Visible to Customer)</label>
                        <textarea name="grading_insights" id="grading_insights" rows="4" 
                            class="w-full bg-[#15171A] border border-white/10 rounded-xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition-colors resize-none placeholder-gray-700"
                            placeholder="Share detailed feedback about the card's condition...">{{ old('grading_insights', $card->grading_insights) }}</textarea>
                    </div>

                    <div class="space-y-4">
                        <label for="admin_notes" class="block text-sm font-bold text-gray-300 uppercase tracking-wider">Internal Tracker (Admin Only)</label>
                        <textarea name="admin_notes" id="admin_notes" rows="4" 
                            class="w-full bg-[#15171A] border border-white/10 rounded-xl px-5 py-4 text-white focus:outline-none focus:border-red-500 transition-colors resize-none placeholder-gray-700"
                            placeholder="Add internal tracking notes, processing details...">{{ old('admin_notes', $card->admin_notes) }}</textarea>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 border border-white/5 rounded-2xl overflow-hidden">
                    <!-- Front Image -->
                    <div class="p-6 bg-white/2 space-y-4">
                        <label class="block text-sm font-bold text-gray-300 uppercase tracking-wider">Front Image (Grading)</label>
                        <div class="space-y-4">
                            <div class="relative group aspect-[3/4] rounded-xl overflow-hidden bg-[#15171A] border border-white/10 shadow-2xl">
                                <img id="front-preview" src="{{ $card->grading_image ? asset('storage/' . $card->grading_image) : '' }}" 
                                    class="w-full h-full object-contain transition-transform duration-500 {{ $card->grading_image ? '' : 'hidden' }}">
                                <div id="front-placeholder" class="absolute inset-0 flex flex-col items-center justify-center text-gray-600 {{ $card->grading_image ? 'hidden' : '' }}">
                                    <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span class="text-[10px] font-bold uppercase tracking-widest">No Front Image</span>
                                </div>
                                <button type="button" id="front-preview-view-btn" onclick="viewImage(document.getElementById('front-preview').src)" class="absolute top-4 right-4 p-2.5 bg-black/60 backdrop-blur-md rounded-lg text-white opacity-0 group-hover:opacity-100 transition-all hover:bg-black/80 hover:scale-110 border border-white/10 {{ $card->grading_image ? '' : 'hidden' }}">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </button>
                            </div>
                            <div class="relative">
                                <input type="file" name="grading_image" id="grading_image" class="hidden" onchange="previewFile(this, 'front-preview', 'front-placeholder')">
                                <label for="grading_image" class="flex items-center justify-center gap-2 w-full py-3 bg-[#15171A] border border-white/5 rounded-xl hover:border-red-500/50 hover:bg-white/5 transition-all cursor-pointer group">
                                    <svg class="w-4 h-4 text-gray-500 group-hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                    <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest group-hover:text-gray-300">Upload Front</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Back Image -->
                    <div class="p-6 bg-white/2 space-y-4 border-l border-white/5">
                        <label class="block text-sm font-bold text-gray-300 uppercase tracking-wider">Back Image</label>
                        <div class="space-y-4">
                            <div class="relative group aspect-[3/4] rounded-xl overflow-hidden bg-[#15171A] border border-white/10 shadow-2xl">
                                <img id="back-preview" src="{{ $card->back_image ? asset('storage/' . $card->back_image) : '' }}" 
                                    class="w-full h-full object-contain transition-transform duration-500 {{ $card->back_image ? '' : 'hidden' }}">
                                <div id="back-placeholder" class="absolute inset-0 flex flex-col items-center justify-center text-gray-600 {{ $card->back_image ? 'hidden' : '' }}">
                                    <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <span class="text-[10px] font-bold uppercase tracking-widest">No Back Image</span>
                                </div>
                                <button type="button" id="back-preview-view-btn" onclick="viewImage(document.getElementById('back-preview').src)" class="absolute top-4 right-4 p-2.5 bg-black/60 backdrop-blur-md rounded-lg text-white opacity-0 group-hover:opacity-100 transition-all hover:bg-black/80 hover:scale-110 border border-white/10 {{ $card->back_image ? '' : 'hidden' }}">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </button>
                            </div>
                            <div class="relative">
                                <input type="file" name="back_image" id="back_image" class="hidden" onchange="previewFile(this, 'back-preview', 'back-placeholder')">
                                <label for="back_image" class="flex items-center justify-center gap-2 w-full py-3 bg-[#15171A] border border-white/5 rounded-xl hover:border-red-500/50 hover:bg-white/5 transition-all cursor-pointer group">
                                    <svg class="w-4 h-4 text-gray-500 group-hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                    <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest group-hover:text-gray-300">Upload Back</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch">
                    <!-- Visibility Control -->
                    <div class="bg-[#1C1E21] p-6 rounded-2xl border border-white/5 group hover:border-emerald-500/20 transition-all flex flex-col justify-center">
                        <div class="flex items-center justify-between gap-6">
                            <div class="space-y-1">
                                <span class="block text-[10px] font-bold text-emerald-500 uppercase tracking-widest leading-none">Status Visibility</span>
                                <h4 class="text-sm font-bold text-white group-hover:text-emerald-400 transition-colors">Reveal Results</h4>
                                <p class="text-[10px] text-gray-500 leading-relaxed font-medium">Publish grade & images to public cert check.</p>
                            </div>
                            <div class="relative flex-shrink-0">
                                <input type="checkbox" name="is_revealed" id="is_revealed_toggle" value="1" {{ old('is_revealed', $card->is_revealed) ? 'checked' : '' }} class="sr-only peer">
                                <label for="is_revealed_toggle" class="w-14 h-8 bg-gray-800 rounded-full border border-white/5 cursor-pointer block relative transition-all duration-300 peer-checked:bg-emerald-500/20 
                                    after:content-[''] after:absolute after:top-1 after:left-1 after:w-6 after:h-6 after:bg-gray-600 after:rounded-full after:transition-all after:duration-300 after:shadow-lg
                                    peer-checked:after:translate-x-6 peer-checked:after:bg-emerald-500">
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- QR Code Actions -->
                    <div class="bg-[#1C1E21] p-6 rounded-2xl border border-white/5 flex items-center gap-6 group hover:border-red-500/20 transition-all">
                        <div id="qr-container" class="p-2 bg-white rounded-lg shadow-xl flex-shrink-0">
                            {!! QrCode::size(80)->generate(route('card.report', $card->cert_number)) !!}
                        </div>
                        <div class="flex-1 space-y-3">
                            <div class="space-y-0.5">
                                <span class="block text-[10px] font-bold text-gray-500 uppercase tracking-widest leading-none">Asset Verification</span>
                                <h4 class="text-xs font-bold text-white uppercase tracking-wider">Public Certificate</h4>
                            </div>
                            <button type="button" onclick="downloadQR()" class="w-full flex items-center justify-center gap-2 py-2 px-3 bg-white/5 hover:bg-white/10 text-gray-400 hover:text-white rounded-xl transition-all text-[10px] font-bold uppercase tracking-widest border border-white/5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                Download PNG
                            </button>
                        </div>
                    </div>
                </div>

                <div class="pt-6 flex flex-col md:flex-row items-center gap-4">
                    <button type="submit" class="w-full md:flex-1 bg-gradient-to-r from-red-600 to-[#A3050A] text-white font-bold py-5 rounded-2xl transition-all shadow-2xl shadow-red-900/40 uppercase tracking-widest text-sm hover:scale-[1.01] active:scale-[0.98] flex items-center justify-center gap-3 group">
                        <span>Save Changes</span>
                        <svg class="w-5 h-5 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </button>
                    <a href="{{ route('admin.submissions.show', $card->submission_id) }}" class="w-full md:w-auto px-10 py-5 bg-white/5 hover:bg-white/10 text-gray-400 hover:text-white rounded-2xl transition-all font-bold uppercase tracking-widest text-sm border border-white/5 text-center">
                        Discard
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Image Viewer Modal -->
<div id="image-modal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4 bg-black/95 backdrop-blur-sm" onclick="this.classList.add('hidden')">
    <div class="relative max-w-5xl w-full h-full flex items-center justify-center" onclick="event.stopPropagation()">
        <img id="modal-img" src="" class="max-w-full max-h-full object-contain rounded-lg shadow-2xl">
        <button type="button" onclick="document.getElementById('image-modal').classList.add('hidden')" class="absolute top-0 right-0 p-4 text-white/50 hover:text-white transition-colors">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>
</div>

<script>
function downloadQR() {
    const svg = document.querySelector('#qr-container svg');
    if (!svg) return;

    // Add necessary namespaces if missing
    if (!svg.getAttribute('xmlns')) svg.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
    
    const svgData = new XMLSerializer().serializeToString(svg);
    const canvas = document.createElement("canvas");
    const ctx = canvas.getContext("2d");
    const img = new Image();
    
    // Use proper base64 encoding that handles special chars
    const svgBase64 = btoa(unescape(encodeURIComponent(svgData)));
    
    img.onload = function() {
        const size = 1000; 
        canvas.width = size;
        canvas.height = size;
        ctx.fillStyle = "white";
        ctx.fillRect(0, 0, size, size);
        ctx.drawImage(img, 0, 0, size, size);
        
        try {
            const pngFile = canvas.toDataURL("image/png");
            const downloadLink = document.createElement("a");
            downloadLink.download = "QR_Cert_{{ $card->cert_number }}.png";
            downloadLink.href = pngFile;
            document.body.appendChild(downloadLink);
            downloadLink.click();
            document.body.removeChild(downloadLink);
        } catch (e) {
            console.error('Download failed', e);
            alert('Could not generate download. Please try Printing instead.');
        }
    };
    
    img.src = "data:image/svg+xml;base64," + svgBase64;
}

function previewFile(input, previewId, placeholderId) {
    const preview = document.getElementById(previewId);
    const placeholder = document.getElementById(placeholderId);
    const viewBtn = document.getElementById(previewId + '-view-btn');
    const file = input.files[0];
    const reader = new FileReader();

    reader.onloadend = function () {
        preview.src = reader.result;
        preview.classList.remove('hidden');
        placeholder.classList.add('hidden');
        if (viewBtn) viewBtn.classList.remove('hidden');
    }

    if (file) {
        reader.readAsDataURL(file);
    }
}

function viewImage(url) {
    const modal = document.getElementById('image-modal');
    const modalImg = document.getElementById('modal-img');
    modalImg.src = url;
    modal.classList.remove('hidden');
}
</script>
@endsection
