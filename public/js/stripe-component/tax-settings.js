

const fetchTaxSettingsClientSecret = async () => {
    // Fetch the AccountSession client secret
    const response = await fetch('/account_session/tax-settings', {
      method: "get",
      headers: {
        "Content-Type": "application/json",
      },
    });
    if (!response.ok) {
      // Handle errors on the client side here
      const {error} = await response.json();
      console.log('An error occurred: ', error);
      document.querySelector('#tax-settings-container').setAttribute('hidden', '');
      document.querySelector('#tax-settings-error').removeAttribute('hidden');
      return undefined;
    } else {

      const res = await response.json();
      
      document.querySelector('#tax-settings-container').removeAttribute('hidden');
      document.querySelector('#tax-settings-error').setAttribute('hidden', '');
      return JSON.parse(res).client_secret;
    }
  }
  
    const instanceTaxSettings = loadConnectAndInitialize({
      // This is your test publishable API key.
      publishableKey: "pk_test_51QacjhJQ4w1zBP0Wp95v7OArYq5w1MZm8Mo9uHDCWOfaMN8rHDt3BbLycxEqRVMQG91UYbpoivIUg6xzqoxf9rMr00RG6bgSdf",
      fetchClientSecret: fetchTaxSettingsClientSecret,

        });

        const containerTaxSettings = document.getElementById("tax-settings-container");
        const taxSettingsComponent = instanceTaxSettings.create("tax-settings");
        containerTaxSettings.appendChild(taxSettingsComponent);