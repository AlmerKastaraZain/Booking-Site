

const fetchBalanceClientSecret = async () => {
    // Fetch the AccountSession client secret
    const response = await fetch('/account_session/balance', {
      method: "get",
      headers: {
        "Content-Type": "application/json",
      },
    });
    if (!response.ok) {
      // Handle errors on the client side here
      const {error} = await response.json();
      console.log('An error payments-container: ', error);
      document.querySelector('#balance-container').setAttribute('hidden', '');
      document.querySelector('#balance-error').removeAttribute('hidden');
      return undefined;
    } else {

      const res = await response.json();
      
      document.querySelector('#balance-container').removeAttribute('hidden');
      document.querySelector('#balance-error').setAttribute('hidden', '');
      return JSON.parse(res).client_secret;
    }
  }
  
    const instanceBalance = loadConnectAndInitialize({
      // This is your test publishable API key.
      publishableKey: "pk_test_51QacjhJQ4w1zBP0Wp95v7OArYq5w1MZm8Mo9uHDCWOfaMN8rHDt3BbLycxEqRVMQG91UYbpoivIUg6xzqoxf9rMr00RG6bgSdf",
      fetchClientSecret: fetchBalanceClientSecret,
      appearance: {
        overlays: 'dialog',
        variables: {
          colorPrimary: '#625afa',
        },
      },
        });

        const container = document.getElementById("balance-container");
        const balanceComponent = instanceBalance.create("balances");
        container.appendChild(balanceComponent);
