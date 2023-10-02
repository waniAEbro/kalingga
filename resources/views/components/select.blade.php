@props(['dataLists', 'name', 'id', 'value' => '', 'label' => 'Please Select'])

<div class="relative text-black" x-data="selectmenu({ @foreach ($dataLists as $dataList) {{ $dataList['id'] }}: '{{ $dataList['name'] }}', @endforeach }, '{{ $value }}', '{{ $label }}')" @click.away="close()">
    <input type="text" x-model="selectedkey" name="{{ $name }}" id="{{ $id }}" class="hidden">
    <span class="inline-block w-full rounded-md shadow-sm" @click="toggle(); $nextTick(() => $refs.filterinput.focus());">
        <button type="button"
            class="relative z-0 w-full py-2 pl-3 pr-10 text-left transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md cursor-default focus:outline-none focus:shadow-outline-blue focus:border-blue-300 sm:text-sm sm:leading-5">
            <span class="block truncate show" x-text="selectedlabel ?? 'Please Select'"></span>

            <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                <svg class="w-5 h-5 text-gray-400" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                    <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </span>
        </button>
    </span>

    <div x-show="state" class="absolute z-10 w-full p-2 mt-1 bg-white rounded-md shadow-lg">
        <input type="text" class="w-full px-2 py-1 mb-1 border border-gray-400 rounded-md" x-model="filter"
            x-ref="filterinput">
        <ul
            class="py-1 overflow-auto text-base leading-6 rounded-md shadow-xs max-h-60 focus:outline-none sm:text-sm sm:leading-5">

            <template x-for="(value, key) in getlist()" :key="key">

                <li @click="select(value, key)" {{ $attributes }} :class="{ 'bg-gray-100': isselected(key) }"
                    class="relative py-1 pl-3 mb-1 text-gray-900 rounded-md cursor-pointer select-none pr-9 hover:bg-gray-100">
                    <span x-text="value" x-bind:title="value" class="block text-sm font-normal truncate"></span>

                    <span x-show="isselected(key)"
                        class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-700">
                        <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </span>
                </li>
            </template>
        </ul>
    </div>
</div>

{{-- @foreach ($dataLists as $dt)
    <div>{{ $dt->name }}</div>
    <div>{{ $dt->id }}</div>
@endforeach --}}
@push('script')
    <script>
        function selectmenu(datalist, selectedKey, selectedlabel) {
            return {
                state: false,
                filter: '',
                list: datalist,
                selectedkey: selectedKey,
                selectedlabel: selectedlabel,
                initialValue: null,
                toggle: function() {
                    this.state = !this.state;
                    this.filter = '';
                },
                close: function() {
                    this.state = false;
                },
                select: function(value, key) {
                    if (this.selectedkey == key) {
                        this.selectedlabel = "Please Select";
                        this.selectedkey = null;
                        this.state = false;
                    } else {
                        this.selectedlabel = value;
                        this.selectedkey = key;
                        this.state = false;
                    }
                },
                isselected: function(key) {
                    return this.selectedkey == key;
                },
                getlist: function() {
                    if (this.filter == '') {
                        return this.list;
                    }
                    var filtered = Object.entries(this.list).filter(([key, value]) => value.toLowerCase().includes(this
                        .filter.toLowerCase()));

                    var result = Object.fromEntries(filtered);
                    return result;
                },


            };
        }
    </script>
@endpush
