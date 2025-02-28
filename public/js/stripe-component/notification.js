

const fetchNotificationClientSecret = async () => {
    // Fetch the AccountSession client secret
    const response = await fetch('/account_session/notification', {
      method: "get",
      headers: {
        "Content-Type": "application/json",
      },
    });
    if (!response.ok) {
      // Handle errors on the client side here
      const {error} = await response.json();
      console.log('An error occurred: ', error);
      document.querySelector('#notification-container').setAttribute('hidden', '');
      document.querySelector('#notification-error').removeAttribute('hidden');
      return undefined;
    } else {

      const res = await response.json();
      
      document.querySelector('#notification-container').removeAttribute('hidden');
      document.querySelector('#notification-error').setAttribute('hidden', '');
      return JSON.parse(res).client_secret;
    }
  }
  
    const instanceNotification = loadConnectAndInitialize({
      // This is your test publishable API key.
      publishableKey: "pk_test_51QacjhJQ4w1zBP0Wp95v7OArYq5w1MZm8Mo9uHDCWOfaMN8rHDt3BbLycxEqRVMQG91UYbpoivIUg6xzqoxf9rMr00RG6bgSdf",
      fetchClientSecret: fetchNotificationClientSecret,
      appearance: {
        overlays: 'dialog',
        variables: {
          colorPrimary: '#625afa',
        },
      },
        });

        const containerNotification = document.getElementById("notification-container");
        const notificationComponent = instanceNotification.create("notification-banner");
        containerNotification.appendChild(notificationComponent);
