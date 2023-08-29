@props(['disabled' => false])

<div class="w-full">
	<input x-data="{ value: @entangle($attributes->wire('model')) }"
	       x-ref="input"
	       x-init="intlTelInput($refs.input, {
	          nationalMode: true,
            utilsScript: 'js/utils.js',
            initialCountry: 'id'
				 })"
	       x-on:change="value = window.intlTelInputGlobals.getNumber()"
	       type="tel"
		{{ $disabled ? 'disabled' : '' }}
		{{ $attributes->merge(['class' => 'form-input block w-full sm:text-sm border-gray-200 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500']) }}
	>
</div>