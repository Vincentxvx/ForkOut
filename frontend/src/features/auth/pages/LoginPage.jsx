import styles from './Page.module.css'
import { useState } from 'react';
import { Link } from 'react-router-dom'
import logo from '../../../assets/forkout-mark-white.svg'


function LoginPage() {
    const [email, setEmail] = useState('')
    const [password, setPassword] = useState('')
    const [error, setError] = useState('')

    function handleSubmit(event) {
        event.preventDefault()
        setError('')

        if (!email.trim() || !password) {
            setError('Please fill in all fields')
            return
        }

        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.trim())) {
            setError('Please enter a valid email address')
            return
        }

        console.log('Email:', email.trim())
    }

    return (
        <main className={styles.page}>
            <div className={styles.logo}>
                <img src={logo} alt="" width="48" height="48" />
                <span>ForkOut</span>
            </div>
            <form className={styles.card} onSubmit={handleSubmit} noValidate>
                <h1 className={styles.title}>Login</h1>

                <label className={styles.field}>
                    E-mail
                    <input 
                        type="email" 
                        autoComplete="email" 
                        value={email} 
                        onChange={(e) => setEmail(e.target.value)}
                    />
                </label>

                <label className={styles.field}>
                    Password
                    <input 
                        type="password" 
                        value={password} 
                        onChange={(e) => setPassword(e.target.value)} 
                        autoComplete="current-password" 
                    />
                </label>

                <button className={styles.submit} type="submit">Login</button>
                <p className={styles.error} role="alert">{error}</p>
                <p style={{ textAlign: 'center' }}>
                    <Link to="/register">Don't have an account? Register here</Link>
                </p>
            </form>
        </main>
    )
}

export default LoginPage