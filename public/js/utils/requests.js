export async function postData(form, formData) {
    try {
        const response = await fetch(form.action, {
            method: "POST",
            body: formData
        });

        if (!response.ok) {
            console.log(`Error - Response status: ${response.status}`)
        }
        
        return await response.json()
    } catch (e) {
        console.log(`Error: ${e}`)
    }
}

export async function getData(url) {
    try {
        const response = await fetch(url + '?' + new URLSearchParams({
            x: 1
        }).toString());

        if (!response.ok) {
            console.log(`Error - Response status: ${response.status}`)
        }
        
        return await response.json()
    } catch (e) {
        console.log(`Error: ${e}`)
    }
}
