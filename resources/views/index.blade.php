{{-- resources/views/index.blade.php --}}
<h1>Homepage Test</h1>

<p>Total Plans: {{ $plans->count() }}</p>
<p>Offer Plan: {{ $offerPlan ? $offerPlan->title : 'No offer' }}</p>
<p>Monthly Plan: {{ $monthlyPlan ? $monthlyPlan->title : 'No monthly plan' }}</p>
<p>Blogs Count: {{ $blogs->count() }}</p>
