<div wire:ignore.self id="personal-info-modern"
     class="content active"
     role="tabpanel"
     aria-labelledby="personal-info-modern-trigger">
    <div class="row">
        <div class="mb-1 col-md-6" x-data="{ isOpen: true }" @click.away="isOpen = false">
            <label class="form-label" for="phone_no">{{__('Phone')}}</label>
            <div class="input-group input-group-merge">
                <input wire:model.defer="phone_no" wire:model.debounce.500ms="search"
                       x-ref="search"
                       @keydown.window="if (event.keyCode === 191) {event.preventDefault(); $refs.search.focus();}"
                       @focus="isOpen = true" @keydown="isOpen = true"
                       @keydown.escape.window="isOpen = false"
                       @keydown.shift.tab="isOpen = false"
                       type="tel" id="phone_no"
                       class="form-control @error('phone_no') is-invalid @enderror"
                       placeholder="{{__('Customer Phone')}}"/>
            </div>
            @if (strlen($search) >= 5)
                <div class="rounded w-80 position-relative"
                     x-show.transition.opacity="isOpen">
                    @if ($searchResults->count() > 0)
                        <ul class="list-group position-absolute w-100 mt-50">
                            @foreach ($searchResults->take(5) as $result)
                                <li class="list-group-item p-1 ">
                                    <button wire:click="setCustomerData({{ $result }})"
                                            @click="isOpen = false" type="button"
                                            class="block border-0 bg-transparent fw-bolder w-100 text-start"
                                            @if ($loop->last) @keydown.tab="isOpen = false" @endif>
                                                                    <span wire:click="setCustomerData({{ $result }})"
                                                                          @click="isOpen = false">{{ $result->name }}</span>
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    @else
                    @endif
                </div>
            @endif
            @if ($errors->has('phone_no'))
                <div style="color: #dc3545;">{{ $errors->first('phone_no') }}</div>
            @endif
        </div>
        <div class="mb-1 col-md-6">
            <input type="hidden" wire:model.defer="customer_id">
            <label class="form-label" for="name">{{__('Name')}}</label>
            <input wire:model.defer="name" type="text" id="name"
                   class="form-control @error('name') is-invalid @enderror"
                   placeholder="{{__('Name')}}"/>
            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="mb-1 col-md-6">
            <label class="form-label" for="email">{{__('Email')}}</label>
            <input wire:model.defer="email" type="email" id="email"
                   class="form-control @error('email') is-invalid @enderror"
                   placeholder="{{__('Email')}}"/>
            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-1 col-md-6">
            <label class="form-label" for="customer-type">{{__('Type')}}</label>
            <div class="form-check form-switch form-check-success agent-single">
                <input wire:model.defer="type" type="checkbox"
                       class="form-check-input" id="type"
                       checked="">
                <label class="form-check-label" for="type">
                    <span class="switch-icon-left">{{__('Other Agency')}}</span>
                    <span class="switch-icon-right">{{__('Individual')}}</span>
                </label>
            </div>
        </div>
    </div>
</div>
