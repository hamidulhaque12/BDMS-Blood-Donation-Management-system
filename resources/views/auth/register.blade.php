{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}


<x-frontend.layouts.master>


    <div class="container-fluid mt-4 mb-4" style="max-width: 700px">
        <div class="card">

            <div class="card-body">
                <div class="card-title text-center">
                    <legend class="fw-bold">Sign Up!</legend>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <span class="fw-light text-decoration-underline m-2">Personal Information:</span>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" value="{{ old('name') }}" class="form-control" id="name" name="name"
                            required>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="father">Fathers' Name: <span class="lead fs-6">(optional)</span></label>
                            <input type="text" value="{{ old('father') }}"  class="form-control" id="father"
                                name="father">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mother">Mothers' Name:<span class="lead fs-6">(optional)</span></label>
                            <input type="text" value="{{ old('mother') }}" name="mother" class="form-control" id="mother">
                        </div>
                    </div>


                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="dob">Date of birth:</label>
                            <input type="date" value="{{ old('dob') }}" class="form-control" name="dob" id="dob"
                                required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="gender">Gender</label>
                            <select id="gender" class="form-control" name="gender">
                                <option selected>Choose...</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="bl">Blood Group</label>
                            <select id="bl" class="form-control" name="blood_group" required>
                                <option selected>Select one..</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="nid">NID Number:</label>
                            <input required type="number" value="{{ old('nid_number') }}" class="form-control"
                                name="nid_number" id="nid" required>
                        </div>

                    </div>
                    <div class="row ">
                        <span class="fw-light text-decoration-underline m-2">Present Address:</span>
                        <div class="form-group col-md-4 col-sm-6">
                            <label for="division">Choose a Division:</label>
                            <select name="division" id="division" class="form-control" required>
                                <option value="">Select One</option>
                            </select>
                        </div>

                        <div class="form-group col-md-4 col-sm-6 ">
                            <label for="district">Choose a District:</label>

                            <select name="district" class="form-control" id="district" required>

                            </select>
                        </div>

                        <div class="form-group col-md-4 col-sm-6">
                            <label for="thana">Choose a Thana:</label>

                            <select name="thana" class="form-control" id="thana" required>

                            </select>
                        </div>

                        <div class="form-group col-md-4 col-sm-6">
                            <label for="postOffice">Post office:</label>

                            <select name="postOffice" class="form-control" id="postOffice" required>

                            </select>
                        </div>
                        <div class="form-group col-md-4 col-sm-6">
                            <label for="postCode">Post code:</label>

                            <select name="postCode" class="form-control" id="postCode">

                            </select>
                        </div>
                    </div>

                    <span class="fw-light text-decoration-underline m-2"></span>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" value="{{ old('email') }}" name="email"
                            required>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="confirmPassword">Confirm Password:</label>
                            <input type="password" class="form-control" name="password_confirmation"
                                id="confirmPassword" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="profile_image" class="form-label">Profile Image:</label>
                            <input class="form-control" type="file" id="profile_image"
                                value="{{ old('profile_image') }}" name="profile_image" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nid_image" class="form-label">Nid image</label>
                            <input class="form-control" type="file" name="nid_image" id="nid_image" value="{{ old('nid_image') }}"
                                required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="form-check justify-content-center">
                                <input class="form-check-input" name="terms" checked type="checkbox" value="agree"
                                    id="invalidCheck2" required>
                                <label class="form-check-label" for="invalidCheck2">
                                    I Agree to <a href="">terms and conditions</a>
                                </label>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <button type="submit" class="btn btn-primary mt-2 w-100">Sign Up</button>
                    </div>


                </form>
            </div>




        </div>
    </div>


</x-frontend.layouts.master>
