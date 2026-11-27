import { useState } from 'react'
import { Link } from 'react-router-dom'
import dummyRecipes from '../dummyRecipes'
import styles from './FeedPage.module.css'

function FeedPage() {
    const recipes = dummyRecipes
    const [index, setIndex] = useState(0)
    const [isMenuOpen, setIsMenuOpen] = useState(false)

    const recipe = recipes[index]

    function showNextRecipe() {
        setIndex((index + 1) % recipes.length)
    }

    return (
        <div className={styles.page}>
            <aside className={styles.sidebar}>
                <p className={styles.logo}>ForkOut</p>
                <input className={styles.search} type="search" placeholder="Search" aria-label="Search recipes" />

                <nav className={styles.nav}>
                    <Link className={styles.navItem} to="/feed">
                        <span className={styles.navIcon} aria-hidden="true">⌂</span>
                        Home
                    </Link>
                    <button className={styles.navItem} type="button">
                        <span className={styles.navIcon} aria-hidden="true">♥</span>
                        Likes / Posts
                    </button>
                </nav>
            </aside>

            <main className={styles.main}>
                {recipes.length === 0 && <p className={styles.message}>No recipes yet.</p>}

                {recipe && (
                    <section className={styles.feed} aria-label="Recipe feed">
                        <div className={styles.column}>
                            <article className={styles.card}>
                                {recipe.media_url ? (
                                    <img className={styles.media} src={recipe.media_url} alt={recipe.name} />
                                ) : (
                                    <div className={styles.mediaPlaceholder}>...</div>
                                )}

                                <div className={styles.overlay}>
                                    <div className={styles.overlayRow}>
                                        <p className={styles.chip}>{recipe.username}</p>
                                        <h1 className={`${styles.chip} ${styles.name}`}>{recipe.name}</h1>
                                    </div>
                                    <ul className={styles.features}>
                                        <li>{recipe.prep_time} min</li>
                                        <li>{recipe.calorie} kcal</li>
                                        <li>{recipe.protein} g protein</li>
                                    </ul>
                                </div>
                            </article>

                            <button className={styles.next} type="button" aria-label="Next recipe" onClick={showNextRecipe}>
                                <svg width="28" height="16" viewBox="0 0 28 16" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round" aria-hidden="true">
                                    <path d="M3 3l11 10 11-10" />
                                </svg>
                            </button>
                        </div>

                        <div className={styles.actions}>
                            <button className={styles.actionButton} type="button" aria-label={`Like, ${recipe.like_count} likes`}>
                                {recipe.like_count}
                                <span className={styles.actionCount}></span>
                            </button>
                            <button className={styles.actionButton} type="button" aria-label="Add to meal plan">+</button>
                            <button className={styles.actionButton} type="button" aria-label="Share">↗</button>
                        </div>
                    </section>
                )}
            </main>

            <div className={styles.profile}>
                <button
                    className={styles.avatar}
                    type="button"
                    aria-label="Profile menu"
                    aria-expanded={isMenuOpen}
                    onClick={() => setIsMenuOpen(!isMenuOpen)}
                >
                    VR
                </button>

                {isMenuOpen && (
                    <ul className={styles.menu}>
                        <li><button type="button">Settings</button></li>
                        <li><button type="button">Plans</button></li>
                        <li><button type="button">History</button></li>
                        <li><button type="button">Progress</button></li>
                        <li><button type="button">Sign out</button></li>
                    </ul>
                )}
            </div>
        </div>
    )
}

export default FeedPage