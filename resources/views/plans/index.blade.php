<!-- resources/views/plans/index.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Subscription Plans</title>
    <link rel="stylesheet" href="{{ asset('stripe/css/stripe_planes.css') }}">
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        h1 {
            text-align: center;
        }
        .row {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .col-md-3 {
            flex-basis: 23%;
            margin-bottom: 20px;
        }
        body {
            background: #C0BFBF;
            padding: 30px 0;
        }
        .badge {
            padding: 2px 2px;
            font-size: 12px;
            font-weight: 500;
            line-height: 1;
            color: #fff;
            border-radius: 4px;
            text-align: center;
            text-transform: uppercase;
            display: inline-block;
        }
        .badge-success {
            background-color: #28a745;
        }
        .badge-danger {
            background-color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Subscribtion Plans</h1>

        <div class="row">
            @foreach ($plans as $plan)
                <div class="col-md-3 col-sm-6">
                    <div class="pricingTable10">
                        <div class="pricingTable-header">
                            <h3 class="heading">{{ $plan->name }}</h3>
                            <span class="price-value">
                                <span class="currency">$</span> {{ $plan->price }}
                                <span class="month">/mo</span>
                            </span>
                        </div>
                        <div class="pricing-content">
                            <ul>
                                <h3>Description:</h3>
                                <li>{{ $plan->description }}</li>
                                <li>Duration: {{ $plan->duration }}</li>
                                <li>Status:
                                    <span class="badge" style="background-color: {{ $plan->status ? '#28a745' : '#dc3545' }}">
                                        {{ $plan->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </li>
                            </ul>
                            <form action="{{ route('subscribe', ['plan' => $plan->id]) }}" method="POST">
                                @csrf
                                <script
                                    src="https://checkout.stripe.com/checkout.js"
                                    class="stripe-button"
                                    data-key="pk_test_51NL7FFCwr8UATqaQA1IR8YNY70bVm6DWWQg2uyZ4qpNDNrbHKR0hozDrx1DXPjnfE4VQY1pwbjII0yvbHKNbPqFa00TgcVdN87"
                                    data-name="Your Package"
                                    data-description="{{ $plan->name }}"
                                    data-amount="{{ $plan->price  }}"
                                    data-currency="usd"
                                    data-email="{{ auth()->user()->email }}"
                                    data-label="BUY NOW"
                                    data-locale="auto">
                                </script>
                            </form>
                            {{-- <a href="#" class="read">BUY NOW</a> --}}
                        </div>
                    </div>
                </div>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
            @endforeach
        </div>
    </div>
</body>
</html>
