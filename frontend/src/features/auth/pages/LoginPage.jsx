import styles from './Page.module.css'
import { Link } from 'react-router-dom'

function LoginPage() {
    return (
        <main className={styles.page}>
            <p className={styles.logo}>ForkOut</p>
            <form className={styles.card}>
                <h1 className={styles.title}>Login</h1>

                <label className={styles.field}>
                    E-mail
                    <input type="text" autoComplete="username" />
                </label>

                <label className={styles.field}>
                    Password
                    <input type="password" autoComplete="current-password" />
                </label>

                <button className={styles.submit} type="submit">Login</button>
                <p style={{ textAlign: 'center' }}>
                    <Link to="/register">Don't have an account? Register here</Link>
                </p>
            </form>
        </main>
    )
}

export default LoginPage