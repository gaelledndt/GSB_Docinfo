export const login = async (data, setUser, setError) => {
    try {
        const response = await fetch('http://127.0.0.1:8000/api/login', {
            method: 'POST',
            mode: 'no-cors',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify(data)
        })
        if(response.ok){
            const result = await response.json()
            console.log("result", result.user)
            setUser(result.user)
        }
        else {
            setError('Une erreur est survenu')
        }
        return response.ok

    }
    catch (e){
        console.log(e.message)
        throw e.message
    }

}

