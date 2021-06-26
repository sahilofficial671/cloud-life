<x-app-layout>
    <x-slot name="title">
        {{ __('Create Vehicle Service') }}
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl px-3 mx-auto sm:px-6 lg:px-8">
            <x-back href="{{ route('vehicles.show', $vehicle->id) }}" />
            <div class="flex flex-col items-center mx-2">
                <x-alert container="w-full sm:max-w-md"/>
                <x-card>
                    <x-slot name="header">
                        {{ __('Create Vehicle Service') }}
                    </x-slot>
                    <x-slot name="body">
                        <form method="POST" action="{{ route('vehicles.services.update', [ 'vehicle' => $vehicle, 'service' => $service]) }}" class="px-6 py-4">
                            @csrf

                            <div class="mb-3 sm:mb-6 space-y-4">
                                <div x-data="dateTime()" x-init="[initDate(), getNoOfDays()]" x-cloak>
                                    <x-label for="scheduled_at" :value="__('Serviced On')" x-text="'Scheduled On'"/>
                                    <x-datetime name="scheduled_at" value="{!! $service->scheduledAt()->toDateString() !!}" />
                                </div>
                            </div>

                            <div class="mb-3 sm:mb-6 space-y-4">
                                <div x-data="dateTime()" x-init="[initDate(), getNoOfDays()]" x-cloak>
                                    <x-label for="serviced_at" :value="__('Serviced On')" x-text="'Serviced On'"/>
                                    <x-datetime name="serviced_at" value="{!! $service->servicedAt()->toDateString() !!}" />
                                </div>
                            </div>

                            <div class="my-3 sm:my-6">
                                <x-label for="type_id" :value="__('Type')" class="mb-1" />
                                <x-select name="type_id" id="type_id">
                                    <option>{{ __('Select Type') }}</option>
                                        @foreach ($types as $id => $type)
                                        <option value="{{ $id }}" {{ old('type_id', $service->type_id) == $id ? 'selected' : ''}}>{{ $type }}</option>
                                        @endforeach
                                </x-select>
                            </div>

                            <div class="my-3 sm:my-6">
                                <x-label for="name" :value="__('Name')" class="mb-1"/>
                                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $service->name)" required autofocus />
                            </div>

                            <div class="my-3 sm:my-6">
                                <x-label for="description" :value="__('Description')" class="mb-1" />
                                <x-textarea id="description" class="block mt-1 w-full" type="textarea" name="description" :value="old('description', $service->description)" required />

                            </div>
                            <x-button type="submit">
                                {{ __('Update') }}
                            </x-button>
                        </form>
                    </x-slot>
                </x-card>
            </div>
        </div>
    </div>

    <script>
        const MONTH_NAMES = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        const DAYS = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

        function dateTime() {
            return {
                isPastService: false,
                showDatepicker: false,
                datepickerValue: '',

                month: '',
                year: '',
                selectedDate: null,
                no_of_days: [],
                blankdays: [],
                days: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],

                isCurrentlySelected(date){
                    const d = new Date(this.year, this.month, date);
                    return this.datepickerValue === d.toDateString() ? true : false;
                },

                initDate() {
                    if(this.$refs.date.value == '' || this.$refs.date.value == undefined){
                        let today = new Date();
                        this.selectedDate = today;
                        this.month = today.getMonth();
                        this.year = today.getFullYear();

                        this.datepickerValue = today.toDateString();
                        var date = today.getFullYear() +"-"+ ('0' + (today.getMonth() + 1)).slice(-2) +"-"+ ('0' + today.getDate()).slice(-2);
                        this.$refs.date.value = date;
                        return;
                    }

                    var date = new Date(this.$refs.date.value);

                    this.selectedDate = date;
                    this.month = date.getMonth();
                    this.year = date.getFullYear();
                    this.datepickerValue = date.toDateString();
                },

                isToday(date) {
                    const today = new Date();
                    const d = new Date(this.year, this.month, date);

                    return today.toDateString() === d.toDateString() ?
                        true :
                        false;
                },

                getDateValue(date, $event) {
                    let selectedDate = new Date(this.year, this.month, date);

                    this.datepickerValue = selectedDate.toDateString();
                    var d = selectedDate.getFullYear() +"-"+ ('0'+ (selectedDate.getMonth() + 1)).slice(-2) +"-"+ ('0' + selectedDate.getDate()).slice(-2);

                    this.$refs.date.value = d;

                    this.showDatepicker = false;
                },

                getNoOfDays() {
                    let daysInMonth = new Date(this.year, this.month + 1, 0).getDate();

                    // find where to start calendar day of week
                    let dayOfWeek = new Date(this.year, this.month).getDay();
                    let blankdaysArray = [];
                    for ( var i = 1; i <= dayOfWeek; i++) {
                        blankdaysArray.push(i);
                    }

                    let daysArray = [];
                    for ( var i=1; i <= daysInMonth; i++) {
                        daysArray.push(i);
                    }

                    this.blankdays = blankdaysArray;
                    this.no_of_days = daysArray;
                }
            }
        }
    </script>
</x-app-layout>
