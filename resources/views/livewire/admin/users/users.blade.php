@section('title', 'Agents')
<div>
    <div class="users-page" wire:ignore.self>
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-body">
                <!-- Bordered table start -->
                <div class="content-header row" id="table-bordered">
                    <div class="content-header-left col-md-9 col-sm-8 col-5 mb-2">
                        <div class="row breadcrumbs-top">
                            <div class="col-12">
                                <h2 class="content-header-title float-start mb-0">{{__('Agents')}}</h2>
                                <div class="breadcrumb-wrapper">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a
                                                href="{{route('dashboard')}}">{{__('Dashboard')}}</a>
                                        </li>
                                        <li class="breadcrumb-item active">{{__('Agents')}}
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    @can('user-create')
                        <div class="content-header-right col-md-3 col-sm-4 col-7 text-end mb-2">
                            <button wire:click.prevent="create" type="button" class="btn btn-outline-primary">
                                {{__('Create Agent')}}
                            </button>
                        </div>
                    @endcan
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header p-0">
                                <!-- Vertical modal -->
                                <div class="vertical-modal-ex">
                                    <!-- Modal -->
                                    @include('livewire.admin.users.modal')
                                    @include('livewire.admin.partials.delete-modal')
                                </div>
                                <!-- Vertical modal end-->
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('Name')}}</th>
                                        <th>{{__('Phone No')}}</th>
                                        <th>{{__('Role')}}</th>
                                        <th>{{__('Percentage')}}</th>
                                        <th>{{__('Created At')}}</th>
                                        @can('user-delete')
                                            <th>{{__('Actions')}}</th>
                                        @elsecan('user-edit')
                                            <th>{{__('Actions')}}</th>
                                        @endcan
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($users as $user )
                                        <tr @if ($loop->last) id="last_record" @endif>
                                            <td data-th="#">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td data-th="Name">
                                                {{ $user->name }}
                                            </td>
                                            <td data-th="Phone No">
                                                {{ $user->phone_no }}
                                            </td>
                                            <td data-th="Role">
                                                @if (!empty($user->roles))
                                                    @foreach ($user->roles as $role)
                                                        <label class="badge bg-primary">{{ $role->name }}</label>
                                                    @endforeach
                                                @endif
                                            </td>
                                              <td data-th="Percentage">
                                                {{ $user->agencies()->first()->pivot->commission }}
                                            </td>

                                            <td data-th="Created At">
                                                {{ $user->created_at->diffForhumans() }}
                                            </td>

                                            <td class="action-set-mob" data-th="Actions">
                                                @can('user-edit')
                                                    <button wire:click.prevent="edit({{ $user }})"
                                                            type="button"
                                                            class="btn btn-warning mt-25">
                                                        <i class="far fa-edit" aria-hidden="true"></i>
                                                    </button>
                                                @endcan
                                                @php
                                                    $phone_no = Crypt::encryptString($user->phone_no);
                                                @endphp
                                                <button
                                                    onclick="shareUserDetails('{{$phone_no}}')"
                                                    type="button"
                                                    aria-haspopup="true"
                                                    aria-expanded="false"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#exampleModalCenter{{$user->phone_no}}"
                                                    class="btn btn-info mt-25">
                                                    <i class="fa fa-share-alt" aria-hidden="true"></i>
                                                </button>
                                                @can('user-delete')
                                                <button wire:click.prevent="confirmUserRemoval({{ $user }})"
                                                        type="button"
                                                        class="btn btn-danger mt-25">
                                                    <i class="far fa-trash-alt" aria-hidden="true"></i>
                                                </button>
                                                @endcan
                                                <button wire:click.prevent="changeUserStatus({{ $user }})"
                                                        type="button"
                                                        class="btn btn-primary mt-25">
                                                 
                                                    @if($user->is_active === 1)
                                                    {{__('Activated')}}
                                                    @else
                                                    {{__('Deactivated')}}
                                                    @endif
                                                </button>
                                                {{-- @include('livewire.admin.users.share') --}}
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="exampleModalCenter{{ $user->phone_no }}" tabindex="-1"
                     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">
                                    Share User Login Details
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="form form-vertical">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="text-start social-share-btns">
                                                <a href="javascript:void(0)"
                                                   class="social-share-wa share__link--whatsapp">
                                                    <i class="fa fa-whatsapp share__link--whatsapp"></i>
                                                </a>
                                                <a href="javascript:void(0)"
                                                   class="social-share-en share__link--mail">
                                                    <i class="far fa-envelope share__link--mail"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div
                                                class="input-group input-group-merge mt-1 shadow">
                                                
                                                <input id="clip-text" type="text"
                                                       class="form-control search-product"
                                                       value="{{"Reset Your Password to Login: " . Request::root() . "/reset-password/" .  Crypt::encryptString($user->phone_no)}}"/>
                                                <span
                                                    class="input-group-text tooltip-btn cursor-pointer"
                                                    data-clipboard-demo=""
                                                    data-clipboard-target="#clip-text"> <i
                                                        data-feather="copy"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="reset" class="btn btn-danger waves-effect"
                                        data-bs-dismiss="modal" aria-label="Close">{{__('Close')}}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @if ($perPage <= $totalRecords)
                                <x-loading-spinner/>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- Bordered table end -->
            </div>
        </div>
    </div>
</div>
@push('scripts')
    @include('livewire.admin.users.social-share')
    <x-load-more/>
@endpush
