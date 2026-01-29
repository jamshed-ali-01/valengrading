@extends('layouts.frontend')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&display=swap" rel="stylesheet">
<div class="min-h-screen bg-[#15171A] text-white font-['Outfit'] py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        <!-- Progress Steps -->
        <div class="mb-12">
            <div class="flex items-center justify-between relative">
                <div class="absolute left-0 top-1/2 w-full h-1 bg-white/5 -z-10 rounded-full"></div>
                
                @foreach(['Submission Type', 'Service Level', 'Card Details', 'Shipping', 'Review', 'Payment'] as $index => $step)
                    <div class="flex flex-col items-center">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm mb-2 transition-all duration-300 relative
                            {{ $index + 1 <= 3 ? 'bg-gradient-to-r from-red-500 to-[#A3050A] shadow-[0_0_15px_rgba(163,5,10,0.4)] scale-110' : 'bg-[#232528] text-gray-500' }}">
                            @if($index + 1 < 3)
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                            @else
                                {{ $index + 1 }}
                            @endif
                        </div>
                        <span class="text-xs font-medium {{ $index + 1 <= 3 ? 'text-white' : 'text-gray-500' }}">{{ $step }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="bg-[#232528]/80 backdrop-blur-xl rounded-2xl border border-white/5 p-8 shadow-2xl relative overflow-hidden group">
            <!-- Glassmorphism Background -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-red-500/10 rounded-full blur-3xl -z-10 transition-all duration-700 group-hover:bg-red-500/15"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-red-900/10 rounded-full blur-3xl -z-10 transition-all duration-700 group-hover:bg-red-900/15"></div>

            <div class="mb-8">
                <h2 class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-red-400 to-[#A3050A] mb-2">Card Details</h2>
                <p class="text-gray-400">Enter your card details using Easy or Detailed mode.</p>
            </div>

            <form action="{{ route('submission.storeStep3') }}" method="POST" id="cardForm">
                @csrf
                <input type="hidden" name="card_entry_mode" id="cardEntryMode" value="{{ old('card_entry_mode', $submission->card_entry_mode ?? 'easy') }}">
                <input type="hidden" id="min_cards" value="{{ $serviceLevel->min_submission ?? 0 }}">
                
                <!-- Toggle & Count Container -->
                <div class="max-w-[340px] mx-auto space-y-4 mb-8">
                    <!-- Toggle Switch -->
                    <div class="p-1.5 bg-[#15171A] rounded-xl flex items-center border border-white/10 w-full">
                        <button type="button" onclick="setMode('easy')" id="easyModeBtn" class="flex-1 px-4 py-2.5 rounded-lg text-sm font-medium transition-all duration-300 relative overflow-hidden text-white bg-gradient-to-r from-red-600 to-[#A3050A] shadow-lg">
                            Easy Submission
                        </button>
                        <button type="button" onclick="setMode('detailed')" id="detailedModeBtn" class="flex-1 px-4 py-2.5 rounded-lg text-sm font-medium transition-all duration-300 relative overflow-hidden text-gray-400 hover:text-white">
                            Detailed Submission
                        </button>
                    </div>

                    <!-- Card Count Input -->
                    <div class="bg-[#15171A]/50 p-3 rounded-xl border border-white/5 flex items-center justify-between gap-4">
                        <span class="text-xs font-bold text-gray-500 uppercase tracking-widest leading-tight">Number of<br>Cards:</span>
                        <div class="relative w-24">
                            <input type="number" name="total_cards" id="total_cards" min="1" 
                                value="{{ old('total_cards', $submission->total_cards ?? '') }}"
                                class="w-full bg-[#15171A] border border-white/10 rounded-lg px-3 py-2 text-white focus:outline-none focus:border-red-500/50 text-center text-xl font-bold transition-all"
                                placeholder="0">
                        </div>
                    </div>
                </div>

                <!-- Easy Mode -->
                <div id="easyMode" class="max-w-md mx-auto">
                    <div class="text-center mb-6">
                        <h3 class="text-xl font-bold text-white mb-2">Easy Mode</h3>
                        <p class="text-sm text-gray-400">Your card count is set above. Proceed directly to shipping.</p>
                    </div>
                </div>

                <!-- Detailed Mode -->
                <div id="detailedMode" class="hidden">
                     <div class="bg-[#15171A] rounded-xl border border-white/10 overflow-hidden mb-6">
                        <div class="p-4 bg-white/5 border-b border-white/10 flex justify-between items-center">
                            <h3 class="font-bold text-white">Itemized List</h3>
                            <button type="button" onclick="addCard()" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-semibold transition-colors shadow-lg shadow-red-900/20">+ Add Card</button>
                        </div>
                        
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-400">
                                <thead class="text-xs text-gray-300 uppercase bg-[#15171A] border-b border-white/10">
                                    <tr>
                                        <th class="px-4 py-3 min-w-[200px]">Title / Player</th>
                                        <th class="px-4 py-3 min-w-[150px]">Set Name</th>
                                        <th class="px-4 py-3 min-w-[100px]">Year</th>
                                        <th class="px-4 py-3 min-w-[100px]">Card #</th>
                                        <th class="px-4 py-3 min-w-[100px]">Lang</th>
                                        <th class="px-4 py-3 min-w-[150px] hidden md:table-cell">Notes</th>
                                        <th class="px-4 py-3 min-w-[180px]">Label Type</th>
                                        <th class="px-4 py-3 w-10"></th>
                                    </tr>
                                </thead>
                                <tbody id="cardsContainer" class="divide-y divide-white/5">
                                    <!-- Cards will be added here dynamically -->
                                </tbody>
                            </table>
                        </div>
                        
                        <div id="detailed-empty-state" class="p-12 text-center text-gray-500">
                            <p class="mb-2">No cards added yet.</p>
                            <button type="button" onclick="addCard()" class="text-red-400 hover:text-red-300 hover:underline">Click to start adding cards</button>
                        </div>
                    </div>
                </div>

                <p id="error-message" class="mt-4 text-center text-sm text-red-500 hidden font-bold bg-red-500/10 p-2 rounded-lg border border-red-500/20"></p>
                @error('cards')
                    <p class="mt-2 text-sm text-red-500 text-center">{{ $message }}</p>
                @enderror

                <div class="flex justify-between items-center pt-8 mt-8 border-t border-white/10">
                    <a href="{{ route('submission.step2') }}" class="px-6 py-3 rounded-xl bg-white/5 text-gray-300 hover:text-white hover:bg-white/10 transition-all duration-300 font-medium border border-white/5">
                        Back
                    </a>
                    
                    <button type="submit" id="submitBtn" class="group relative px-8 py-3 rounded-xl bg-gradient-to-r from-red-600 to-[#A3050A] text-white font-bold shadow-[0_0_20px_rgba(163,5,10,0.3)] hover:shadow-[0_0_30px_rgba(163,5,10,0.5)] hover:scale-[1.02] transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed">
                        <span class="relative z-10 flex items-center gap-2">
                            Proceed to Shipping
                            <svg class="w-5 h-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                            </svg>
                        </span>
                        <div class="absolute inset-0 rounded-xl bg-white/10 blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    // Pass PHP data to JS
    window.labelTypes = @json($labelTypes);
    window.existingCards = @json(old('cards', $submission->cards ?? []));
    window.initialMode = @json(old('card_entry_mode', $submission->card_entry_mode ?? 'easy'));

    const modeInput = document.getElementById('cardEntryMode');
    const easyModeBtn = document.getElementById('easyModeBtn');
    const detailedModeBtn = document.getElementById('detailedModeBtn');
    const easyModeDiv = document.getElementById('easyMode');
    const detailedModeDiv = document.getElementById('detailedMode');
    const totalCardsInput = document.getElementById('total_cards');
    const cardsContainer = document.getElementById('cardsContainer');
    const emptyState = document.getElementById('detailed-empty-state');
    const errorMessage = document.getElementById('error-message');
    const submitBtn = document.getElementById('submitBtn');
    const minCards = parseInt(document.getElementById('min_cards').value) || 0;

    function setMode(mode) {
        modeInput.value = mode;
        if (mode === 'easy') {
            easyModeBtn.classList.remove('text-gray-400', 'hover:text-white');
            easyModeBtn.classList.add('text-white', 'bg-gradient-to-r', 'from-red-600', 'to-[#A3050A]', 'shadow-lg');
            
            detailedModeBtn.classList.add('text-gray-400', 'hover:text-white');
            detailedModeBtn.classList.remove('text-white', 'bg-gradient-to-r', 'from-red-600', 'to-[#A3050A]', 'shadow-lg');
            
            easyModeDiv.classList.remove('hidden');
            detailedModeDiv.classList.add('hidden');
            
            // Disable inputs so they don't block validation
            document.querySelectorAll('#cardsContainer input, #cardsContainer select').forEach(el => {
                el.value = ''; // Clear value
                el.setAttribute('disabled', 'disabled');
            });
        } else {
            detailedModeBtn.classList.remove('text-gray-400', 'hover:text-white');
            detailedModeBtn.classList.add('text-white', 'bg-gradient-to-r', 'from-red-600', 'to-[#A3050A]', 'shadow-lg');
            
            easyModeBtn.classList.add('text-gray-400', 'hover:text-white');
            easyModeBtn.classList.remove('text-white', 'bg-gradient-to-r', 'from-red-600', 'to-[#A3050A]', 'shadow-lg');
            
            detailedModeDiv.classList.remove('hidden');
            easyModeDiv.classList.add('hidden');
            
            // Enable inputs
            document.querySelectorAll('#cardsContainer input, #cardsContainer select').forEach(el => el.removeAttribute('disabled'));
            
            syncRowsWithCount();
        }
        validate();
    }

    function syncRowsWithCount() {
        if (modeInput.value !== 'detailed') return;
        
        const count = parseInt(totalCardsInput.value) || 0;
        const currentRows = cardsContainer.children.length;
        
        if (count > currentRows) {
            for (let i = 0; i < count - currentRows; i++) {
                addCard();
            }
        } else if (count < currentRows) {
            for (let i = 0; i < currentRows - count; i++) {
                cardsContainer.lastElementChild.remove();
            }
            if (cardsContainer.children.length === 0) {
                emptyState.classList.remove('hidden');
            }
            reindexRows();
        }
    }

    function addCard(data = null) {
        if (cardsContainer.children.length === 0) {
            emptyState.classList.add('hidden');
        }
        
        const index = cardsContainer.children.length;
        const row = document.createElement('tr');
        row.className = 'bg-[#15171A]/50 hover:bg-white/5 transition-colors group/row';
        
        let labelOptions = '<option value="" disabled selected>Select</option>';
        window.labelTypes.forEach(type => {
             let displayPrice = type.price_adjustment == 0 ? 'Free' : (type.price_adjustment > 0 ? '+€'+type.price_adjustment : '-€'+Math.abs(type.price_adjustment));
             let selected = data && data.label_type_id == type.id ? 'selected' : '';
             labelOptions += `<option value="${type.id}" ${selected}>${type.name} (${displayPrice})</option>`;
        });

        row.innerHTML = `
            <td class="p-2 min-w-[200px]"><input type="text" name="cards[${index}][title]" value="${data ? data.title || '' : ''}" placeholder="Title / Player" class="w-full bg-[#15171A] border border-white/10 rounded-lg px-3 py-2 text-white text-sm focus:outline-none focus:ring-1 focus:ring-red-500 placeholder-gray-600" required></td>
            <td class="p-2 min-w-[150px]"><input type="text" name="cards[${index}][set_name]" value="${data ? data.set_name || '' : ''}" placeholder="Set" class="w-full bg-[#15171A] border border-white/10 rounded-lg px-3 py-2 text-white text-sm focus:outline-none focus:ring-1 focus:ring-red-500 placeholder-gray-600"></td>
            <td class="p-2 min-w-[100px]"><input type="text" name="cards[${index}][year]" value="${data ? data.year || '' : ''}" placeholder="Year" class="w-full bg-[#15171A] border border-white/10 rounded-lg px-3 py-2 text-white text-sm focus:outline-none focus:ring-1 focus:ring-red-500 placeholder-gray-600"></td>
            <td class="p-2 min-w-[100px]"><input type="text" name="cards[${index}][card_number]" value="${data ? data.card_number || '' : ''}" placeholder="#" class="w-full bg-[#15171A] border border-white/10 rounded-lg px-3 py-2 text-white text-sm focus:outline-none focus:ring-1 focus:ring-red-500 placeholder-gray-600"></td>
            <td class="p-2 min-w-[100px]"><input type="text" name="cards[${index}][lang]" value="${data ? data.lang || '' : ''}" placeholder="Lang" class="w-full bg-[#15171A] border border-white/10 rounded-lg px-3 py-2 text-white text-sm focus:outline-none focus:ring-1 focus:ring-red-500 placeholder-gray-600"></td>
            <td class="p-2 min-w-[150px] hidden md:table-cell"><input type="text" name="cards[${index}][notes]" value="${data ? data.notes || '' : ''}" placeholder="Notes" class="w-full bg-[#15171A] border border-white/10 rounded-lg px-3 py-2 text-white text-sm focus:outline-none focus:ring-1 focus:ring-red-500 placeholder-gray-600"></td>
            <td class="p-2 min-w-[180px]">
                <select name="cards[${index}][label_type_id]" class="w-full bg-[#15171A] border border-white/10 rounded-lg px-3 py-2 text-white text-sm focus:outline-none focus:ring-1 focus:ring-red-500 appearance-none cursor-pointer" required>
                    ${labelOptions}
                </select>
            </td>
            <td class="p-2 text-center">
                <button type="button" class="text-gray-500 hover:text-red-500 transition-colors remove-row p-1 rounded hover:bg-red-500/10">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </td>
        `;
        
        cardsContainer.appendChild(row);
        
        // Add event listeners
        row.querySelector('.remove-row').addEventListener('click', function() {
            row.remove();
            if (cardsContainer.children.length === 0) {
                emptyState.classList.remove('hidden');
            }
            reindexRows();
            totalCardsInput.value = cardsContainer.children.length; // Sync back to count
            validate();
        });
        
        row.querySelectorAll('input, select').forEach(input => {
            input.addEventListener('input', validate);
        });

        if (modeInput.value === 'detailed') {
            totalCardsInput.value = cardsContainer.children.length; // Sync back to count
        }
        
        validate();
    }
    
    function reindexRows() {
        Array.from(cardsContainer.children).forEach((row, idx) => {
            row.querySelectorAll('input, select').forEach(input => {
                const name = input.getAttribute('name');
                if (name) {
                    input.setAttribute('name', name.replace(/cards\[\d+\]/, `cards[${idx}]`));
                }
            });
        });
    }

    function validate() {
        let isValid = true;
        let errorText = '';
        
        const count = parseInt(totalCardsInput.value) || 0;
        
        if (minCards > 0 && count < minCards) {
            isValid = false;
            errorText = `Minimum ${minCards} cards required.`;
        } else if (count <= 0) {
            isValid = false;
        }
        
        if (modeInput.value === 'detailed') {
            const rows = cardsContainer.children.length;
            if (rows === 0) isValid = false;
            
            // Check filled inputs
             let allFilled = true;
             document.querySelectorAll('#cardsContainer input[required], #cardsContainer select[required]').forEach(el => {
                 if (!el.value) allFilled = false;
             });
             if (!allFilled) isValid = false;
        }

        if (errorText) {
            errorMessage.textContent = errorText;
            errorMessage.classList.remove('hidden');
        } else {
            errorMessage.classList.add('hidden');
        }

        if (isValid && !errorText) {
            submitBtn.removeAttribute('disabled');
        } else {
            submitBtn.setAttribute('disabled', 'disabled');
        }
    }

    // Init
    totalCardsInput.addEventListener('input', () => {
        syncRowsWithCount();
        validate();
    });
    
    // Check initial state
    setMode(window.initialMode);
    
    if (window.existingCards && window.existingCards.length > 0) {
        window.existingCards.forEach(card => addCard(card));
    }
    
    validate();

    // AJAX Login Modal Logic
    const cardForm = document.getElementById('cardForm');
    let authCheckPassed = false;

    cardForm.addEventListener('submit', function(e) {
        @guest
            if (!authCheckPassed) {
                e.preventDefault();
                openLoginModal();
            }
        @endguest
    });

    // In the login-modal.blade.php success handler, we'll set authCheckPassed = true and re-submit
    // Actually, calling .submit() on the form DOM element doesn't fire the 'submit' event again, so it's safe.
    
    // We already have mainForm.submit() in the modal script.

</script>

@endsection


