

const fetchReportingCartClientSecret = async () => {
    // Fetch the AccountSession client secret
    const response = await fetch('/account_session/reporting-chart', {
      method: "get",
      headers: {
        "Content-Type": "application/json",
      },
    });
    if (!response.ok) {
      // Handle errors on the client side here
      const {error} = await response.json();
      console.log('An error occurred: ', error);
      document.querySelector('#reporting-chart-container').setAttribute('hidden', '');
      document.querySelector('#reporting-chart-error').removeAttribute('hidden');
      return undefined;
    } else {

      const res = await response.json();
      console.log(res);
      
      document.querySelector('#reporting-chart-container').removeAttribute('hidden');
      document.querySelector('#reporting-chart-error').setAttribute('hidden', '');
      return JSON.parse(res).client_secret;
    }
  }
  
    const instanceReportingChart = loadConnectAndInitialize({
      // This is your test publishable API key.
      publishableKey: "pk_test_51QacjhJQ4w1zBP0Wp95v7OArYq5w1MZm8Mo9uHDCWOfaMN8rHDt3BbLycxEqRVMQG91UYbpoivIUg6xzqoxf9rMr00RG6bgSdf",
      fetchClientSecret: fetchReportingCartClientSecret,
      appearance: {
        overlays: 'dialog',
        variables: {
          colorPrimary: '#625afa',
        },
      },
        });

        const containerReportingChart = document.getElementById("reporting-chart-container");
        const reportingChartComponent = instanceReportingChart.create("reporting-chart");
        reportingChartComponent.setReportName("net_volume");
        reportingChartComponent.setIntervalStart(new Date(2023, 11, 17));
        reportingChartComponent.setIntervalEnd(new Date(2024, 8, 18));
        reportingChartComponent.setIntervalType("day");
        containerReportingChart.appendChild(reportingChartComponent);
