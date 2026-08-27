@extends('layouts.app')

@section('title', 'Reviews')

@section('content')

<div class="container mt-5">

    <h1 class="mb-4">
        Reviews for {{ $prodact->title }}
    </h1>

    @if(session('Success'))
        <div class="alert alert-success">
            {{ session('Success') }}
        </div>
    @endif

    {{-- Add Review --}}
    <div class="card mb-4">

        <div class="card-header">
            <h2 class="mb-0">Add Review</h2>
        </div>

        <div class="card-body">

            <form action="{{ route('reviews.store') }}" method="POST">

                @csrf

                {{-- Product ID --}}
                <input
                    type="hidden"
                    name="prodact_id"
                    value="{{ $prodact->id }}"
                >

                {{-- Rating --}}
                <div class="mb-3">

                    <label class="form-label">
                        Rating:
                    </label>

                    <input
                        type="hidden"
                        name="rating"
                        id="rating"
                        value="0"
                        required
                    >

                    <div
                        id="starRating"
                        style="font-size: 35px; cursor: pointer;"
                    >

                        <span data-value="1">☆</span>
                        <span data-value="2">☆</span>
                        <span data-value="3">☆</span>
                        <span data-value="4">☆</span>
                        <span data-value="5">☆</span>

                    </div>

                    <small id="ratingText" class="text-muted">
                        Click a star
                    </small>

                </div>

                {{-- Comment --}}
                <div class="mb-3">

                    <label class="form-label">
                        Comment:
                    </label>

                    <textarea
                        name="comment"
                        class="form-control"
                        rows="4"
                        required
                    ></textarea>

                </div>

                <button
                    type="submit"
                    class="btn btn-primary"
                >
                    Add Review
                </button>

            </form>

        </div>

    </div>


    {{-- Show Reviews --}}
    <h2 class="mb-3">
        Reviews
    </h2>

    @if($reviews->count() > 0)

        @foreach($reviews as $review)

            <div class="card mb-3">

                <div class="card-body">

                    {{-- User --}}
                    <p>
                        <strong>User:</strong>

                        {{ $review->user->name ?? 'User' }}
                    </p>

                    {{-- Rating --}}
                    <p>
                        <strong>Rating:</strong>

                        @for($i = 1; $i <= 5; $i++)

                            @if($i <= $review->rating)
                                ⭐
                            @else
                                ☆
                            @endif

                        @endfor

                        ({{ $review->rating }}/5)
                    </p>

                    {{-- Comment --}}
                    <p>
                        <strong>Comment:</strong>

                        {{ $review->comment }}
                    </p>


                    {{-- Edit & Delete only for owner --}}
                    @if($review->user_id == auth()->id())

                        <a
                            href="{{ route('reviews.edit', $review->id) }}"
                            class="btn btn-warning"
                        >
                            Edit
                        </a>

                        <form
                            action="{{ route('reviews.destroy', $review->id) }}"
                            method="POST"
                            class="d-inline"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-danger"
                            >
                                Delete
                            </button>

                        </form>

                    @endif

                </div>

            </div>

        @endforeach

    @else

        <div class="alert alert-info">
            No reviews for this product yet.
        </div>

    @endif

</div>


{{-- Star Rating JavaScript --}}
<script>

    const stars = document.querySelectorAll('#starRating span');

    const rating = document.getElementById('rating');

    const ratingText = document.getElementById('ratingText');


    stars.forEach(star => {

        star.addEventListener('click', function () {

            const value = this.dataset.value;

            // Save rating
            rating.value = value;

            // Change stars
            stars.forEach(s => {

                if (Number(s.dataset.value) <= Number(value)) {

                    s.textContent = '⭐';

                } else {

                    s.textContent = '☆';

                }

            });

            // Show rating number
            ratingText.textContent = value + ' / 5';

        });

    });

</script>

@endsection
