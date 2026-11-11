import styles from './Page.module.css'
import { useState } from 'react';
import { Link } from 'react-router-dom'
import logo from '../../../assets/forkout-mark-white.svg'

function RegisterPage() {
    const [email, setEmail] = useState('')
    const [password, setPassword] = useState('')
    const [confirmPassword, setConfirmPassword] = useState('')
    const [userName, setUserName] = useState('')
    const [error, setError] = useState('')

    function handleSubmit(event){
        event.preventDefault()
        setError('')
        if(!email.trim() || !password || !confirmPassword || !userName.trim()) {
            setError('Please fill in all fields')
            return
        }
        
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.trim())) {
            setError('Please enter a valid email address')
            return
        }
        
        if(password.length < 8) {
            setError('Password must be at least 8 characters long')
            return
        }

        if(password !== confirmPassword) {
            setError('Passwords do not match')
            return
        }

        console.log('Email:', email.trim())
        console.log('Username:', userName.trim())
    }
    return (
        <main className={styles.page}>
            <div className={styles.logo}>
                <img src={logo} alt="" width="48" height="48" />
                <span>ForkOut</span>
            </div>
            <form className={styles.card} onSubmit={handleSubmit} noValidate>
                <h1 className={styles.title}>Sign up</h1>

                <label className={styles.field}>
                    Email address
                    <input type="email" autoComplete="email" value={email} onChange={(e) => setEmail(e.target.value)}/>
                </label>

                <label className={styles.field}>
                    Username
                    <input type="text" autoComplete="username" value={userName} onChange={(e) => setUserName(e.target.value)}/>
                </label>

                <label className={styles.field}>
                    Password
                    <input type="password" autoComplete="new-password" value={password} onChange={(e) => setPassword(e.target.value)}/>
                </label>

                <label className={styles.field}>
                    Password again
                    <input type="password" autoComplete="new-password" value={confirmPassword} onChange={(e) => setConfirmPassword(e.target.value)}/>
                </label>

                <button className={styles.submit} type="submit">Sign up</button>
                <p className={styles.error} role="alert">{error}</p>
                <p style={{ textAlign: 'center' }}>
                    <Link to="/login">Already have an account? Log in here</Link>
                </p>
            </form>
        </main>
    )
}

export default RegisterPage
