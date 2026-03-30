@extends('admin.layouts.admin')

@section('title', 'Destination Brief & Highlights')
@section('page-title', 'Destination Brief & Highlights')
@section('breadcrumb', 'Countries / Destination Brief & Highlights')

@section('content')
    <form method="POST" action="{{ route('admin.countries.destination-brief.update', $country) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        @php
            $resolveImageUrl = function (?string $image): ?string {
                if (!filled($image)) {
                    return null;
                }

                if (\Illuminate\Support\Str::startsWith($image, ['http://', 'https://', '//', 'data:'])) {
                    return $image;
                }

                if (\Illuminate\Support\Str::startsWith($image, ['storage/', '/storage/'])) {
                    return asset(ltrim($image, '/'));
                }

                if (\Illuminate\Support\Str::startsWith($image, ['uploads/', '/uploads/'])) {
                    return asset(ltrim($image, '/'));
                }

                return asset('storage/' . ltrim($image, '/'));
            };

            $fallbackPool = array_values(array_filter([
                $resolveImageUrl($country->highlight_1_image),
                $resolveImageUrl($country->highlight_2_image),
                $resolveImageUrl($country->highlight_3_image),
                $resolveImageUrl($country->highlight_4_image),
            ]));

            $existingHighlightsById = $country->highlights->keyBy('id');
        @endphp

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 md:p-8 space-y-8">
            <div class="rounded-xl border border-[var(--color-forest-green)]/15 bg-[var(--color-forest-green)]/[0.04] px-4 py-4 md:px-5">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900">{{ $country->name }}</h3>
                        <p class="text-sm text-gray-600 mt-1">
                            Manage destination brief content, climate slices, and highlights for the public country page.
                        </p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $country->is_published ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-700' }}">
                            {{ $country->is_published ? 'Published' : 'Draft' }}
                        </span>
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-white border border-gray-200 text-gray-700">
                            /countries/{{ $country->slug }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2">
                <h4 class="text-base font-semibold text-gray-900">Destination Brief</h4>
                <a href="{{ route('admin.countries.edit', $country) }}" class="text-sm text-[var(--color-forest-green)] hover:underline">
                    Back to main country editor
                </a>
            </div>

            <div>
                <label for="destination_brief_lead" class="block text-sm font-medium text-gray-700 mb-2">Destination Brief Lead</label>
                <textarea id="destination_brief_lead" name="destination_brief_lead" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)] focus:border-[var(--color-forest-green)]">{{ old('destination_brief_lead', $country->destination_brief_lead ?: ($destinationDefaults['lead'] ?? '')) }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div><label for="destination_brief_capital" class="block text-sm font-medium text-gray-700 mb-2">Capital</label><input type="text" id="destination_brief_capital" name="destination_brief_capital" value="{{ old('destination_brief_capital', $country->destination_brief_capital ?: ($destinationDefaults['capital'] ?? '')) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)]"></div>
                <div><label for="destination_brief_currency" class="block text-sm font-medium text-gray-700 mb-2">Currency</label><input type="text" id="destination_brief_currency" name="destination_brief_currency" value="{{ old('destination_brief_currency', $country->destination_brief_currency ?: ($destinationDefaults['currency'] ?? '')) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)]"></div>
                <div><label for="destination_brief_languages" class="block text-sm font-medium text-gray-700 mb-2">Languages</label><input type="text" id="destination_brief_languages" name="destination_brief_languages" value="{{ old('destination_brief_languages', $country->destination_brief_languages ?: ($destinationDefaults['languages'] ?? '')) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)]"></div>
                <div><label for="destination_brief_time_zone" class="block text-sm font-medium text-gray-700 mb-2">Time Zone</label><input type="text" id="destination_brief_time_zone" name="destination_brief_time_zone" value="{{ old('destination_brief_time_zone', $country->destination_brief_time_zone ?: ($destinationDefaults['time_zone'] ?? '')) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)]"></div>
                <div><label for="destination_brief_airports" class="block text-sm font-medium text-gray-700 mb-2">Main Airports</label><input type="text" id="destination_brief_airports" name="destination_brief_airports" value="{{ old('destination_brief_airports', $country->destination_brief_airports ?: ($destinationDefaults['airports'] ?? '')) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)]"></div>
                <div><label for="destination_brief_best_for" class="block text-sm font-medium text-gray-700 mb-2">Best For</label><input type="text" id="destination_brief_best_for" name="destination_brief_best_for" value="{{ old('destination_brief_best_for', $country->destination_brief_best_for ?: ($destinationDefaults['best_for'] ?? '')) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)]"></div>
                <div><label for="destination_brief_ideal_trip_length" class="block text-sm font-medium text-gray-700 mb-2">Ideal Trip Length</label><input type="text" id="destination_brief_ideal_trip_length" name="destination_brief_ideal_trip_length" value="{{ old('destination_brief_ideal_trip_length', $country->destination_brief_ideal_trip_length ?: ($destinationDefaults['ideal_trip_length'] ?? '')) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)]"></div>
                <div><label for="destination_brief_best_time" class="block text-sm font-medium text-gray-700 mb-2">Best Time to Visit</label><input type="text" id="destination_brief_best_time" name="destination_brief_best_time" value="{{ old('destination_brief_best_time', $country->destination_brief_best_time ?: ($destinationDefaults['best_time'] ?? '')) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)]"></div>
                <div><label for="destination_brief_travel_style" class="block text-sm font-medium text-gray-700 mb-2">Travel Style</label><input type="text" id="destination_brief_travel_style" name="destination_brief_travel_style" value="{{ old('destination_brief_travel_style', $country->destination_brief_travel_style ?: ($destinationDefaults['style'] ?? '')) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)]"></div>
                <div><label for="destination_brief_ecosystems" class="block text-sm font-medium text-gray-700 mb-2">Ecosystems</label><input type="text" id="destination_brief_ecosystems" name="destination_brief_ecosystems" value="{{ old('destination_brief_ecosystems', $country->destination_brief_ecosystems ?: ($destinationDefaults['ecosystems'] ?? '')) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)]"></div>
                <div><label for="destination_brief_entry_requirements" class="block text-sm font-medium text-gray-700 mb-2">Entry Requirements</label><input type="text" id="destination_brief_entry_requirements" name="destination_brief_entry_requirements" value="{{ old('destination_brief_entry_requirements', $country->destination_brief_entry_requirements ?: ($destinationDefaults['entry'] ?? '')) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)]"></div>
                <div><label for="destination_brief_health_notes" class="block text-sm font-medium text-gray-700 mb-2">Health Notes</label><input type="text" id="destination_brief_health_notes" name="destination_brief_health_notes" value="{{ old('destination_brief_health_notes', $country->destination_brief_health_notes ?: ($destinationDefaults['health'] ?? '')) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)]"></div>
            </div>

            <div>
                <label for="destination_brief_climate_intro" class="block text-sm font-medium text-gray-700 mb-2">Climate Intro</label>
                <textarea id="destination_brief_climate_intro" name="destination_brief_climate_intro" rows="2" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)]">{{ old('destination_brief_climate_intro', $country->destination_brief_climate_intro ?: ($destinationDefaults['climate_intro'] ?? '')) }}</textarea>
            </div>

            <div class="pt-1">
                <h4 class="text-base font-semibold text-gray-900 mb-3">Climate Windows</h4>
                <p class="text-sm text-gray-600 mb-4">Use concise labels and one-line notes to keep this section easy to scan on the public page.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach([1,2,3] as $i)
                    <div class="border border-gray-200 rounded-xl p-4 bg-gray-50/50">
                        <label for="destination_brief_climate_{{ $i }}_season" class="block text-sm font-medium text-gray-700 mb-1">Climate {{ $i }} Season</label>
                        <input type="text" id="destination_brief_climate_{{ $i }}_season" name="destination_brief_climate_{{ $i }}_season" value="{{ old("destination_brief_climate_{$i}_season", $country->{"destination_brief_climate_{$i}_season"} ?: ($destinationDefaults['climate'][$i - 1]['season'] ?? '')) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg mb-2">
                        <label for="destination_brief_climate_{{ $i }}_note" class="block text-sm font-medium text-gray-700 mb-1">Climate {{ $i }} Note</label>
                        <input type="text" id="destination_brief_climate_{{ $i }}_note" name="destination_brief_climate_{{ $i }}_note" value="{{ old("destination_brief_climate_{$i}_note", $country->{"destination_brief_climate_{$i}_note"} ?: ($destinationDefaults['climate'][$i - 1]['note'] ?? '')) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                    </div>
                @endforeach
            </div>

            <div>
                <label for="highlights_title" class="block text-sm font-medium text-gray-700 mb-2">Highlights Section Title</label>
                <input type="text" id="highlights_title" name="highlights_title" value="{{ old('highlights_title', $country->highlights_title) }}" placeholder="Highlights" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[var(--color-forest-green)]">
            </div>

            @php
                $highlightRows = old('highlights');
                if (is_array($highlightRows)) {
                    $highlightRows = array_values(array_map(function ($row, $idx) use ($existingHighlightsById, $resolveImageUrl, $fallbackPool) {
                        $rowId = isset($row['id']) ? (int) $row['id'] : null;
                        $existing = $rowId ? $existingHighlightsById->get($rowId) : null;
                        $imageUrl = $existing ? $resolveImageUrl($existing->image) : null;
                        $row['image_url'] = $imageUrl ?: ($fallbackPool[$idx] ?? ($fallbackPool[0] ?? null));
                        return $row;
                    }, $highlightRows, array_keys($highlightRows)));
                } else {
                    $highlightRows = [];
                    foreach ($country->highlights as $idx => $item) {
                        $highlightRows[] = [
                            'id' => $item->id,
                            'title' => $item->title,
                            'text' => $item->text,
                            'image_url' => $resolveImageUrl($item->image) ?: ($fallbackPool[$idx] ?? ($fallbackPool[0] ?? null)),
                        ];
                    }
                    if (count($highlightRows) === 0) {
                        foreach ($highlightDefaults as $idx => $default) {
                            $highlightRows[] = [
                                'id' => null,
                                'title' => $default['title'] ?? '',
                                'text' => $default['text'] ?? '',
                                'image_url' => $fallbackPool[$idx] ?? ($fallbackPool[0] ?? null),
                            ];
                        }
                    }
                }
            @endphp

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 border-t border-gray-100 pt-6">
                <div>
                    <h4 class="text-base font-semibold text-gray-900">Highlights</h4>
                    <p class="text-sm text-gray-600 mt-1">Add as many highlights as you need. These render in alternating image/text rows.</p>
                </div>
                <button type="button" id="add-highlight-row" class="px-3 py-2 text-sm rounded-lg border border-[var(--color-forest-green)] text-[var(--color-forest-green)] hover:bg-[var(--color-forest-green)] hover:text-white transition-colors">
                    + Add Highlight
                </button>
            </div>

            <div id="highlights-repeater" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($highlightRows as $i => $row)
                    @php
                        $previewUrl = $row['image_url'] ?? null;
                    @endphp
                    <div class="border border-gray-200 rounded-xl p-4 space-y-3 highlight-row bg-white shadow-sm" data-index="{{ $i }}">
                        <input type="hidden" name="highlights[{{ $i }}][id]" value="{{ $row['id'] ?? '' }}">
                        <input type="hidden" name="highlights[{{ $i }}][_delete]" value="0" class="highlight-delete-flag">
                        <div class="flex items-center justify-between">
                            <h5 class="font-medium text-gray-800">Highlight <span class="highlight-row-number">{{ $i + 1 }}</span></h5>
                            <button type="button" class="text-sm text-red-600 hover:text-red-800 remove-highlight-row">Remove</button>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                            <input type="text" name="highlights[{{ $i }}][title]" value="{{ $row['title'] ?? '' }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Text</label>
                            <textarea id="highlight_{{ $i + 1 }}_text" name="highlights[{{ $i }}][text]" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg">{{ $row['text'] ?? '' }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                            <div class="mb-2">
                                <img src="{{ $previewUrl ?? '' }}" alt="Highlight preview" class="w-40 h-24 object-cover rounded border border-gray-200 highlight-preview {{ $previewUrl ? '' : 'hidden' }}">
                                <p class="text-xs text-gray-500 highlight-placeholder {{ $previewUrl ? 'hidden' : '' }}">No image selected yet.</p>
                            </div>
                            <input type="file" name="highlights[{{ $i }}][image]" accept="image/jpeg,image/png,image/gif,image/webp,image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg highlight-image-input">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="sticky bottom-0 z-20 bg-white/95 backdrop-blur border border-gray-200 rounded-xl px-4 py-3 flex justify-end space-x-4">
            <a href="{{ route('admin.countries.edit', $country) }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors">
                Back
            </a>
            <button type="submit" class="px-6 py-2 bg-[var(--color-forest-green)] text-white rounded-[var(--radius-button)] hover:bg-opacity-90 transition-colors font-medium shadow-sm">
                Save Destination Brief & Highlights
            </button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const repeater = document.getElementById('highlights-repeater');
            const addButton = document.getElementById('add-highlight-row');

            function bindPreview(row) {
                const input = row.querySelector('.highlight-image-input');
                const preview = row.querySelector('.highlight-preview');
                const placeholder = row.querySelector('.highlight-placeholder');
                if (!input || !preview || !placeholder) {
                    return;
                }
                input.addEventListener('change', function (event) {
                    const file = event.target.files && event.target.files[0];
                    if (!file) {
                        return;
                    }
                    preview.src = URL.createObjectURL(file);
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                });
            }

            function bindRemove(row) {
                const removeBtn = row.querySelector('.remove-highlight-row');
                const deleteFlag = row.querySelector('.highlight-delete-flag');
                if (!removeBtn || !deleteFlag) {
                    return;
                }
                removeBtn.addEventListener('click', function () {
                    const idInput = row.querySelector('input[name$="[id]"]');
                    if (idInput && idInput.value) {
                        deleteFlag.value = '1';
                        row.classList.add('hidden');
                    } else {
                        row.remove();
                    }
                });
            }

            function bindAllRows() {
                repeater.querySelectorAll('.highlight-row').forEach(function (row) {
                    bindPreview(row);
                    bindRemove(row);
                });
            }

            addButton.addEventListener('click', function () {
                const nextIndex = repeater.querySelectorAll('.highlight-row').length;
                const html = `
                    <div class="border border-gray-200 rounded-xl p-4 space-y-3 highlight-row bg-white shadow-sm" data-index="${nextIndex}">
                        <input type="hidden" name="highlights[${nextIndex}][id]" value="">
                        <input type="hidden" name="highlights[${nextIndex}][_delete]" value="0" class="highlight-delete-flag">
                        <div class="flex items-center justify-between">
                            <h5 class="font-medium text-gray-800">Highlight <span class="highlight-row-number">${nextIndex + 1}</span></h5>
                            <button type="button" class="text-sm text-red-600 hover:text-red-800 remove-highlight-row">Remove</button>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                            <input type="text" name="highlights[${nextIndex}][title]" value="" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Text</label>
                            <textarea name="highlights[${nextIndex}][text]" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg"></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                            <div class="mb-2">
                                <img src="" alt="Highlight preview" class="w-40 h-24 object-cover rounded border border-gray-200 highlight-preview hidden">
                                <p class="text-xs text-gray-500 highlight-placeholder">No image selected yet.</p>
                            </div>
                            <input type="file" name="highlights[${nextIndex}][image]" accept="image/jpeg,image/png,image/gif,image/webp,image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg highlight-image-input">
                        </div>
                    </div>
                `;
                repeater.insertAdjacentHTML('beforeend', html);
                const row = repeater.lastElementChild;
                bindPreview(row);
                bindRemove(row);
            });

            bindAllRows();
        });
    </script>
@endsection
