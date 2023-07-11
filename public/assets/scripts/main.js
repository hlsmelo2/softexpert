const mainObject = {
    getApiUrl(endpoint) {
        return location.origin + '/api/' + endpoint;
    },
    killLoader() {
        const loader = document.querySelector('div#loader');

        setTimeout(loader.parentElement.removeChild.bind(loader.parentElement, loader), 1000);
    },
    isFilledArray(aArray) {
        return (
            aArray instanceof Array &&
            'concat' in aArray &&
            typeof(aArray) !== 'string' &&
            aArray.length > 0
        );
    },
    getRequestBody(bodyObject) {
        const formData = new FormData();

        Object.keys(bodyObject).forEach(function(key) {
            formData.append( key, bodyObject[key] );
        });

        return formData;
    },
    sendRequest(url, method, options) {
        const newOptions = { method };
        options = (options === undefined) ? {} : options;

        if (options.body !== undefined) {
            newOptions.body = this.getRequestBody(options.body);
            delete(options.body);
        }

        if (sessionStorage.getItem('session') !== null) {
            options.headers = Object.assign(
                {},
                options.headers,
                { 'Authorization' : 'Bearer ' + sessionStorage.getItem('session') }, 
            );
        }

        if (options.headers !== undefined) {
            options.headers = new Headers(options.headers);
        }

        Object.assign(newOptions, options);

        return fetch(url, newOptions);
    },
    getTextRequest(url, method, options) {
        return this.sendRequest(url, method, options)
            .then(function(response) { return response.text(); })
            .then(function(text) { return text; });
    },
    getJSONRequest(url, method, options) {
        return this.sendRequest(url, method, options)
            .then(function(response) { return response.json(); })
            .then(function(json) { return json; });
    },
};
