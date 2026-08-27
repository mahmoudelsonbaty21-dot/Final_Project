@extends('layouts.app')

@section('title', 'Edit Review')

@section('content')

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card">

                <div class="card-header">
                    <h3 class="mb-0">Edit Review</h3>
                </div>

                <div class="card-body">

                    <form
                        action="{{ route('reviews.update', $review->id) }}"
                        method="POST"
                    >

                        @csrf
                        @method('PUT')


                        {{-- Rating --}}
                        <div class="mb-3">

                            <label class="form-label">
                                Rating:
                            </label>

                            <input
                                type="hidden"
                                name="rating"
                                id="rating"
                                value="{{ $review->rating }}"
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
                                {{ $review->rating }} / 5
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
                                rows="5"
                                required
                            >{{ $review->comment }}</textarea>

                        </div>


                        {{-- Buttons --}}
                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            Update Review
                        </button>

                        <a
                            href="{{ route('reviews.index', $review->prodact_id) }}"
                            class="btn btn-secondary"
                        >
                            Back
                        </a>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>


{{-- Star Rating JavaScript --}}
<script>

    const stars = document.querySelectorAll('#starRating span');

    const rating = document.getElementById('rating');

    const ratingText = document.getElementById('ratingText');


    function showStars(value) {

        stars.forEach(star => {

            if (Number(star.dataset.value) <= Number(value)) {

                star.textContent = '⭐';

            } else {

                star.textContent = '☆';

            }

        });

        ratingText.textContent = value + ' / 5';
    }


    // Show the current rating when page opens
    showStars(rating.value);


    // Change rating when clicking a star
    stars.forEach(star => {

        star.addEventListener('click', function () {

            const value = this.dataset.value;

            rating.value = value;

            showStars(value);

        });

    });

</script>

@endsection
