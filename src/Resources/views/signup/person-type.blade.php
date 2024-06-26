<?php
use Helidalto\BagCliente\Helper\Helper;

$config = Helper::getPersonType();
$default = \Illuminate\Support\Str::contains($config, ',') ? 'person' : $config;

$personType = old('person_type') ? old('person_type') : $default;
?>
<person-type></person-type>

@extends('brcustomer::scripts')

@push('scripts')
    <script type="text/x-template" id="input-document">
        <div class="person-type">
            @if(\Illuminate\Support\Str::is($config, 'person,company'))
                <div class="control-group mb-4" :class="[errors.has('person_type') ? 'has-error' : '']">
                    <p>{{ __('Person Type') }}</p>
                    <label class="radio-container mr-2">
                        <input
                            type="radio"
                            id="person_type_person"
                            name="person_type"
                            data-vv-as="&quot;{{ __('Person Type') }}&quot;" v-model="person_type" value="person" />
                        <span class="checkmark">{{ __('Person') }}</span>
                    </label>

                    <label class="radio-container">
                        <input
                            type="radio"
                            id="person_type_company"
                            name="person_type"
                            data-vv-as="&quot;{{ __('Person Type') }}&quot;"  v-model="person_type" value="company" />
                        <span class="checkmark">{{ __('Company') }}</span>
                    </label>
                </div>
            @else
                <input type="hidden" id="person_type" name="person_type" v-model="person_type" value="{{ $config }}" />
            @endif

            <div class="control-group mb-4" :class="[errors.has('document') ? 'has-error' : '']">
                <label for="document" class="required label-style">
                    @{{ documentLabel }}
                </label>

                <input
                    type="text"
                    v-mask="documentMask"
                    class="form-style control"
                    name="document"
                    v-validate="'required'"
                    value="{{ old('document') }}"
                    :data-vv-as="documentLabel" />

                <span class="control-error" v-if="errors.has('document')">
                    @{{ errors.first('document') }}
                </span>
            </div>

            @if (\Helidalto\BagCliente\Helper\Helper::isShowStateRegister())
                <div class="control-group mb-4" :class="[errors.has('state_register') ? 'has-error' : '']" v-if="person_type == 'company'">
                    <label for="state_register" class="required label-style">
                        <input type="checkbox" v-model="hasStateRegister" value="1" checked> {{ __('State Register') }}
                    </label>

                    <input
                        type="text"
                        class="form-style control"
                        name="state_register"
                        v-validate="'required'"
                        value="{{ old('state_register') }}"
                        v-model="state_register"
                        :data-vv-as="&quot;{{ __('State Register') }}&quot;" :readonly="readOnlyStateRegistar" />

                    <span class="control-error" v-if="errors.has('state_register')">
                        @{{ errors.first('state_register') }}
                    </span>
                </div>
            @endif

            <div class="control-group mb-4" :class="[errors.has('company_name') ? 'has-error' : '']" v-if="person_type == 'company'">
                <label for="company_name" class="required label-style">
                   {{ __('Company Name') }}
                </label>

                <input
                    type="text"
                    class="form-style control"
                    name="company_name"
                    v-validate="'required'"
                    value="{{ old('company_name') }}"
                    :data-vv-as="&quot;{{ __('Company Name') }}&quot;" />

                <span class="control-error" v-if="errors.has('company_name')">
                    @{{ errors.first('company_name') }}
                </span>
            </div>

            @if (\Helidalto\BagCliente\Helper\Helper::isShowFantasyName())
                <div class="control-group mb-4" :class="[errors.has('fantasy_name') ? 'has-error' : '']" v-if="person_type == 'company'">
                    <label for="fantasy_name" class="required label-style">
                        {{ __('Fantasy Name') }}
                    </label>

                    <input
                        type="text"
                        class="form-style control"
                        name="fantasy_name"
                        v-validate="'required'"
                        value="{{ old('fantasy_name') }}"
                        :data-vv-as="&quot;{{ __('Fantasy Name') }}&quot;" />

                    <span class="control-error" v-if="errors.has('fantasy_name')">
                        @{{ errors.first('fantasy_name') }}
                    </span>
                </div>
            @endif

            @if (\Helidalto\BagCliente\Helper\Helper::isShowGeneralRegister())
                <div class="control-group mb-4" :class="[errors.has('general_register') ? 'has-error' : '']" v-if="person_type == 'person'">
                    <label for="general_register" class="required label-style">
                        {{ __('General Register') }}
                    </label>

                    <input
                        type="text"
                        class="form-style control"
                        name="general_register"
                        v-validate="'required'"
                        value="{{ old('general_register') }}"
                        :data-vv-as="&quot;{{ __('General Register') }}&quot;" />

                    <span class="control-error" v-if="errors.has('general_register')">
                        @{{ errors.first('general_register') }}
                    </span>
                </div>
            @endif
        </div>
    </script>

    <script type="text/javascript">
        Vue.component('person-type', {
            template: '#input-document',
            inject: ['$validator'],
            data: function () {
                return {
                    person_type: '{{ $personType }}',
                    state_register: "{{ old('company_name') }}",
                    hasStateRegister: 1,
                    config: {
                        person: {
                            label: "{{ __('Document Person') }}"
                        },
                        company: {
                            label: "{{ __('Document Company') }}"
                        }
                    }
                }
            },
            computed: {
                documentLabel: function () {
                    if (this.person_type == 'person') {
                        return this.config.person.label;
                    }
                    return this.config.company.label;
                },

                readOnlyStateRegistar: function () {
                    return this.state_register === '{{ __("Exempt") }}';
                },

                documentMaxlength: function () {
                    return this.person_type == 'person' ? 14 : 18;
                },

                documentMask: function () {
                    return this.person_type == 'person' ? '###.###.###-##' : '##.###.###/####-##';
                }
            },
            watch: {
                hasStateRegister: function (val) {
                    this.state_register = (val ? null : '{{ __("Exempt") }}');
                },
            }
        });
    </script>
@endpush






