

const fetchPaymentMethodClientSecret = async () => {
    // Fetch the AccountSession client secret
    const response = await fetch('/account_session/payment-method-settings', {
      method: "get",
      headers: {
        "Content-Type": "application/json",
      },
    });
    if (!response.ok) {
      // Handle errors on the client side here
      const {error} = await response.json();
      console.log('An error occurred: ', error);
      document.querySelector('#payment-method-settings-container').setAttribute('hidden', '');
      document.querySelector('#payment-method-settings-error').removeAttribute('hidden');
      return undefined;
    } else {

      const res = await response.json();

      console.log(res);
      document.querySelector('#payment-method-settings-container').removeAttribute('hidden');
      document.querySelector('#payment-method-settings-error').setAttribute('hidden', '');
      return JSON.parse(res).client_secret;
    }
  }
  
    const instancePaymentMethod = loadConnectAndInitialize({
      // This is your test publishable API key.
      publishableKey: "pk_test_51QacjhJQ4w1zBP0Wp95v7OArYq5w1MZm8Mo9uHDCWOfaMN8rHDt3BbLycxEqRVMQG91UYbpoivIUg6xzqoxf9rMr00RG6bgSdf",
      fetchClientSecret: fetchPaymentMethodClientSecret,
        });

        const containerPaymentMethod = document.getElementById("payment-method-settings-container");
        const paymentMethodSettingsComponent = instancePaymentMethod.create("payment-method-settings");
        containerPaymentMethod.appendChild(paymentMethodSettingsComponent);
