<div>
    @if ($open)

    <div class="bg-transparent z-40 relative w-screen h-screen" @keydown.enter.document.prevent="$refs.submit.click()">
        <div class="fixed inset-0 w-full h-full z-20 bg-black bg-opacity-50 duration-300 overflow-y-auto p-7">
            <div class="relative sm:w-3/4 md:w-2/3 lg:w-1/2 mx-2 sm:mx-auto my-10 opacity-100 bg-white" @mousedown.away="@this.call('closeModal')">
                <div class="flex flex-col items-start w-full">
                    <div class="pt-7 pb-4 flex items-center w-full border border-b-3">
                        <div class="title text-gray-900 font-bold text-3xl text-center w-full">
                            {{ __('app.Create Tenant') }}
                        </div>
                        <svg wire:click="closeModal" class="{{ LaravelLocalization::getCurrentLocaleDirection() == 'ltr' ? 'ml-auto mr-6' : 'mr-auto ml-6' }} fill-current text-gray-700 w-5 h-5 cursor-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18">
                            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z" />
                        </svg>
                    </div>

                    <div class="body px-7 pt-3 pb-7 overflow-hidden w-full">
                        <div class="flex flex-col mb-4">
                            <label for="name_en" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                {{ __('app.English Name') }}
                                <span class="text-red-600 ml-1 font-bold">*</span>
                            </label>
                            <input id="name_en" type="text" class="border border-gray-300 p-2 outline-none w-full mt-2 rounded-md" wire:model.defer="name.en">
                            @error("name.en") <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                        </div>
                        <div class="flex flex-col mb-4">
                            <label for="name_ar" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                {{ __('app.Arabic Name') }}
                            </label>
                            <input id="name_ar" type="text" class="border border-gray-300 p-2 outline-none w-full mt-2 rounded-md" wire:model.defer="name.ar">
                            @error("name.ar") <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                        </div>
                        <div class="flex flex-col mb-4">
                            <label for="email" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                {{ __('app.Email Address') }}
                            </label>
                            <input id="email" type="text" class="border border-gray-300 p-2 outline-none w-full mt-2 rounded-md" wire:model.defer="email">
                            @error("email") <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                        </div>
                        <div class="flex flex-col mb-4">
                            <label for="phone" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                {{ __('app.Phone Number') }}
                            </label>
                            <input id="phone" type="text" class="border border-gray-300 p-2 outline-none w-full mt-2 rounded-md" wire:model.defer="phone">
                            @error("phone") <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                        </div>
                        <div class="flex flex-col mb-4">
                            <label for="birthday" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                {{ __('app.Birthday') }}
                                <span class="text-red-600 ml-1 font-bold">*</span>
                            </label>
                            <input id="birthday" type="date" class="border border-gray-300 p-2 outline-none w-full mt-2 rounded-md" wire:model.defer="birthday">
                            @error("birthday") <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                        </div>
                        <div class="flex flex-col mb-4">
                            <label for="natinality_id" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                {{ __('app.Nationality') }}
                                <span class="text-red-600 ml-1 font-bold">*</span>
                            </label>
                            <div class="relative inline-flex">
                                <svg class="w-2 h-2 absolute top-0 right-0 m-4 pointer-events-none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 412 232"><path d="M206 171.144L42.678 7.822c-9.763-9.763-25.592-9.763-35.355 0-9.763 9.764-9.763 25.592 0 35.355l181 181c4.88 4.882 11.279 7.323 17.677 7.323s12.796-2.441 17.678-7.322l181-181c9.763-9.764 9.763-25.592 0-35.355-9.763-9.763-25.592-9.763-35.355 0L206 171.144z" fill="#648299" fill-rule="nonzero"/></svg>
                                <select class="border border-gray-300 rounded-full text-gray-600 h-10 pl-5 pr-10 bg-white hover:border-gray-400 focus:outline-none appearance-none w-full" wire:model.defer="nationality_id" id="nationality_id">
                                    <option value="" selected class="text-grey-600">{{ __('app.Choose Nationality') }}</option>
                                    @foreach ($nationalities as $nationality)
                                        <option value="{{ $nationality->id }}" class="text-grey-600">{{ $nationality->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error("nationality_id") <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                        </div>
                        <div class="flex flex-col mb-4">
                            <label for="national_card_no" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                {{ __('app.National Card Number') }}
                            </label>
                            <input id="national_card_no" type="text" class="border border-gray-300 p-2 outline-none w-full mt-2 rounded-md" wire:model.defer="national_card_no">
                            @error("national_card_no") <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                        </div>
                        <div class="flex flex-col mb-4">
                            <label for="passport_no" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                {{ __('app.Passport Number') }}
                            </label>
                            <input id="passport_no" type="text" class="border border-gray-300 p-2 outline-none w-full mt-2 rounded-md" wire:model.defer="passport_no">
                            @error("passport_no") <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                        </div>
                        <div class="flex flex-col mb-4">
                            <label class="inline-flex items-center mt-3">
                                <input type="checkbox" class="form-checkbox h-5 w-5 text-indigo-600" wire:model.defer="married"><span class="ml-2 text-gray-700">{{ __('app.Married') }}</span>
                            </label>
                            @error("married") <span class="text-xs text-red-600">{{ $message }}</span> @enderror
                        </div>
                        <div class="border-t border-gray-200">
                            <button class="text-sm mt-4 uppercase px-8 py-2 rounded bg-indigo-500 text-blue-50 w-full shadow-sm hover:shadow-lg transition-all duration-200" wire:click="storeTenant" wire:loading.attr="disabled" wire:loading.class="bg-opacity-50" x-ref="submit">{{ __('app.Save') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endif
</div>
