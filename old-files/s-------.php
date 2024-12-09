
                    <!-- Include Stripe.js -->
                    <script src="https://js.stripe.com/v3/"></script>

<!-- Your payment form with Payment Request API and Stripe Elements -->
<form id="payment-form">
  <!-- A container for the Payment Request API -->
  <div id="payment-request-button"></div>

  <!-- Include a container to display card details using Stripe Elements -->
  <div id="card-element"></div>

  <!-- A placeholder for the error messages -->
  <div id="card-errors" role="alert"></div>

  <!-- Submit button -->
  <button type="button" id="submit">
    Pay
  </button>
</form>

<!-- Your JavaScript to initialize Stripe Elements and handle payment submission -->
<script>
  var stripe = Stripe('pk_test_51HaRBvH4rZ2esk0gHmBSga6Ol6eZuBPWgCEFGpFhYYCj3jdr56FZ3amU8NKSHad9DzM947vK1vUML0cwPWLmkQD900SJRjXf6g');
  var elements = stripe.elements();

  // Create an instance of the card Element
  var card = elements.create('card');

  // Add an instance of the card Element into the `card-element` div
  card.mount('#card-element');

  // Create a Payment Request button
  var paymentRequest = stripe.paymentRequest({
    country: 'US',
    currency: 'usd',
    total: {
      label: 'Total',
      amount: 1000, // Amount in cents
    },
  });

  var prButton = elements.create('paymentRequestButton', {
    paymentRequest: paymentRequest,
  });

    // Check the availability of the Payment Request API
    paymentRequest.canMakePayment().then(function(result) {
        if (result) {
            prButton.mount('#payment-request-button');
        } else {
            document.getElementById('payment-request-button').style.display = 'none';
        }
    });

    // Handle real-time validation errors from the card Element
    card.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    // Handle form submission
    document.getElementById('submit').addEventListener('click', function() {
        // Use the Payment Request API if available, otherwise use the card Element
        if (paymentRequest && paymentRequest.paymentRequest) {
            paymentRequest.show();
        } else {
            stripe.createPaymentMethod({
                type: 'card',
                card: card,
            }).then(function(result) {
                if (result.error) {
                // Show error to your customer
                console.log(result.error.message);
                } else {
                    // Send the payment method ID to your server
                    console.log(result.paymentMethod.id);
                    // Send the result.paymentMethod.id to your server using AJAX or a form submission
                    // After getting result.paymentMethod.id
                    var paymentMethodId = result.paymentMethod.id;

                    // Make an AJAX request to your server
                    fetch('./stripe-connect/subscription.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ account_id: 'acct_1OHHzHH6FVx9mTYd', paymentMethodId: paymentMethodId }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Handle the response from the server if needed
                        console.log(data);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                }
            });
        }
    });
</script>