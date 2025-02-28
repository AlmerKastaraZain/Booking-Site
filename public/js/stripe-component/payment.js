

const fetchPaymentClientSecret = async () => {
    // Fetch the AccountSession client secret
    const response = await fetch('/account_session/payment', {
      method: "get",
      headers: {
        "Content-Type": "application/json",
      },
    });
    if (!response.ok) {
      // Handle errors on the client side here
      const {error} = await response.json();
      console.log('An error occurred: ', error);
      document.querySelector('#payment-container').setAttribute('hidden', '');
      document.querySelector('#payment-error').removeAttribute('hidden');
      return undefined;
    } else {

      const res = await response.json();
      
      document.querySelector('#payment-container').removeAttribute('hidden');
      document.querySelector('#payment-error').setAttribute('hidden', '');
      return JSON.parse(res).client_secret;
    }
  }
  
    const instancePayment = loadConnectAndInitialize({
      // This is your test publishable API key.
      publishableKey: "pk_test_51QacjhJQ4w1zBP0Wp95v7OArYq5w1MZm8Mo9uHDCWOfaMN8rHDt3BbLycxEqRVMQG91UYbpoivIUg6xzqoxf9rMr00RG6bgSdf",
      fetchClientSecret: fetchPaymentClientSecret,
      appearance: {
        overlays: 'dialog',
        variables: {
          colorPrimary: '#625afa',
        },
      },
        });

        const containerPayment = document.getElementById("payment-container");
        const paymentsComponent = instancePayment.create("payments");
        containerPayment.appendChild(paymentsComponent);
