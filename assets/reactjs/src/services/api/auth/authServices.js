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
        console.log(response.ok)
        if(response.ok){
            const result = await response.json()
            console.log(result)
            setUser(result)
        }
        else {
            setError('Une erreur est survenu')
        }
    }
    catch (e){
        console.log(e.message)
    }

}

