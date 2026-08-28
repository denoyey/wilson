import { gsap } from 'gsap';

export class PageAnimator {
    constructor() {
        this.init();
    }

    init() {
        this.animatePage();

        document.addEventListener('livewire:navigated', () => {
            this.animatePage();
        });
    }

    animatePage() {
        this.animateFadeUp();
        this.animateStaggerItems();
        this.animateListItems();
        this.animateLogin();
    }

    animateLogin() {
        if (document.querySelectorAll('.gsap-card').length > 0) {
            gsap.fromTo('.gsap-card',
                { y: 30, opacity: 0, scale: 0.95 },
                { y: 0, opacity: 1, scale: 1, duration: 0.8, ease: 'back.out(1.2)' }
            );
            
            gsap.fromTo('.gsap-login-item',
                { y: 20, opacity: 0 },
                { y: 0, opacity: 1, duration: 0.6, stagger: 0.1, ease: 'power2.out', delay: 0.3 }
            );
        }
    }

    animateFadeUp() {
        const elements = document.querySelectorAll('.gsap-fade-up');
        if (elements.length > 0) {
            gsap.fromTo(elements, {
                y: 30,
                opacity: 0
            }, {
                y: 0,
                opacity: 1,
                duration: 0.8,
                stagger: 0.1,
                ease: 'power3.out'
            });
        }
    }

    animateStaggerItems() {
        const elements = document.querySelectorAll('.gsap-stagger-item');
        if (elements.length > 0) {
            gsap.fromTo(elements, {
                y: 30,
                opacity: 0
            }, {
                y: 0,
                opacity: 1,
                duration: 0.6,
                stagger: 0.15,
                ease: 'power3.out',
                delay: 0.2
            });
        }
    }

    animateListItems() {
        const elements = document.querySelectorAll('.gsap-list-item:nth-child(-n+10)');
        if (elements.length > 0) {
            gsap.fromTo(elements, {
                x: -20,
                opacity: 0
            }, {
                x: 0,
                opacity: 1,
                duration: 0.5,
                stagger: 0.05,
                ease: 'power2.out',
                delay: 0.5
            });
        }
    }
}
