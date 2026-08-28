import Lenis from 'lenis';
import { gsap } from 'gsap';
import 'lenis/dist/lenis.css';
import '@fontsource/manrope';


// Initialize Lenis once
const lenis = new Lenis({
    autoResize: true,
});

// Use GSAP's ticker to drive Lenis's requestAnimationFrame
// This prevents any native requestAnimationFrame conflicts or stack overflows
gsap.ticker.add((time) => {
    lenis.raf(time * 1000);
});
gsap.ticker.lagSmoothing(0);

// Re-calculate dimensions after Livewire navigates
document.addEventListener('livewire:navigated', () => {
    lenis.resize();
});

// Initialize Animations
import { PageAnimator } from './animations';
const animator = new PageAnimator();

// Export for global usage
gsap.config({ nullTargetWarn: false });
window.gsap = gsap;
window.lenis = lenis;
window.animator = animator;