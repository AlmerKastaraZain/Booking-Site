

const fetchAccountManagementClientSecret = async () => {
    // Fetch the AccountSession client secret
    const response = await fetch('/account_session/account-management', {
      method: "get",
      headers: {
        "Content-Type": "application/json",
      },
    });
    if (!response.ok) {
      // Handle errors on the client side here
      const {error} = await response.json();
      console.log('An error occurred: ', error);
      document.querySelector('#account-management-container').setAttribute('hidden', '');
      document.querySelector('#account-management-error').removeAttribute('hidden');
      return undefined;
    } else {

      const res = await response.json();
      
      document.querySelector('#account-management-container').removeAttribute('hidden');
      document.querySelector('#account-management-error').setAttribute('hidden', '');
      return JSON.parse(res).client_secret;
    }
  }
  
    const instanceAccountManagement = loadConnectAndInitialize({
      // This is your test publishable API key.
      publishableKey: "pk_test_51QacjhJQ4w1zBP0Wp95v7OArYq5w1MZm8Mo9uHDCWOfaMN8rHDt3BbLycxEqRVMQG91UYbpoivIUg6xzqoxf9rMr00RG6bgSdf",
      fetchClientSecret: fetchAccountManagementClientSecret,
      appearance: {
        overlays: 'dialog',
        variables: {
          colorPrimary: '#625afa',
        },
      },
        });

    const containerAccountManagement = document.getElementById("account-management-container");
    const accountManagementComponent = instanceAccountManagement.create('account-management');
    containerAccountManagement.appendChild(accountManagementComponent);