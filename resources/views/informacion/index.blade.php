<x-navbar>
    <h1>User Information</h1>
    <p><strong>ID:</strong> {{ $user->id }}</p>
    <p><strong>Nickname:</strong> {{ $user->nickname }}</p>
    <p><strong>Registration Date:</strong> {{ \Carbon\Carbon::parse($user->registration_date)->format('Y-m-d H:i:s') }}
    </p>
    <p><strong>First Name:</strong> {{ $user->first_name }}</p>
    <p><strong>Last Name:</strong> {{ $user->last_name }}</p>
    <p><strong>Country:</strong> {{ $user->country_id }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Identification Number:</strong> {{ $user->identification->number }}</p>
    <p><strong>Identification Type:</strong> {{ $user->identification->type }}</p>
    <p><strong>Secure Email:</strong> {{ $user->secure_email }}</p>

    <h2>Address Information</h2>
    <p><strong>City:</strong> {{ $user->address->city ?? 'N/A' }}</p>
    <p><strong>State:</strong> {{ $user->address->state ?? 'N/A' }}</p>
    <p><strong>ZIP Code:</strong> {{ $user->address->zip_code ?? 'N/A' }}</p>

    <h2>Phone Information</h2>
    <p><strong>Area Code:</strong> {{ $user->phone->area_code ?? 'N/A' }}</p>
    <p><strong>Phone Number:</strong> {{ $user->phone->number ?? 'N/A' }}</p>

    <h2>Seller Reputation</h2>
    <p><strong>Seller Experience:</strong> {{ $user->seller_experience }}</p>
    <p><strong>Total Transactions:</strong> {{ $user->seller_reputation->transactions->total }}</p>
    <p><strong>Completed Transactions:</strong> {{ $user->seller_reputation->transactions->completed }}</p>

    <h2>Buyer Reputation</h2>
    <p><strong>canceled Transactions:</strong> {{ $user->buyer_reputation->canceled_transactions }}</p>

    <h2>Registration Identifiers</h2>
    @if (!empty($user->registration_identifiers))
        <p><strong>Registration Type:</strong> {{ $user->registration_identifiers[0]->registration_type }}</p>
        <p><strong>Country Code:</strong> {{ $user->registration_identifiers[0]->metadata->country_code }}</p>
        <p><strong>Phone Number:</strong> {{ $user->registration_identifiers[0]->metadata->number }}</p>
    @else
        <p>No registration identifiers available.</p>
    @endif

    <h2>Thumbnail</h2>
    @if (isset($user->thumbnail->picture_url))
        <img src="{{ $user->thumbnail->picture_url }}" alt="User Thumbnail">
    @else
        <p>No thumbnail available.</p>
    @endif

    <h2>More Details</h2>
    <p><a href="{{ $user->permalink }}" target="_blank">View Profile</a></p>
</x-navbar>
