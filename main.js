import * as THREE from 'https://cdn.skypack.dev/three@0.132.2';

class Portfolio3D {
    constructor() {
        this.container = document.getElementById('canvas-container');
        this.scene = new THREE.Scene();
        this.camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        this.renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });

        this.points = null;
        this.mouseX = 0;
        this.mouseY = 0;

        this.init();
        this.createParticles();
        this.animate();
        this.handleResize();
        this.handleMouse();
        this.initScrollReveal();
        this.initModal();
    }

    init() {
        this.renderer.setSize(window.innerWidth, window.innerHeight);
        this.renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
        this.container.appendChild(this.renderer.domElement);
        this.camera.position.z = 5;
    }

    initModal() {
        const modal = document.getElementById('imageModal');
        const modalImg = document.getElementById('modalImage');
        const closeBtn = document.getElementById('modalClose');
        const projectImgs = document.querySelectorAll('.project-img-wrapper');

        projectImgs.forEach(wrapper => {
            wrapper.addEventListener('click', () => {
                const img = wrapper.querySelector('img');
                modalImg.src = img.src;
                modal.classList.add('active');
                document.body.style.overflow = 'hidden'; // Prevent scroll
            });
        });

        const closeModal = () => {
            modal.classList.remove('active');
            document.body.style.overflow = 'auto';
            setTimeout(() => { modalImg.src = ''; }, 400); // Clear src after transition
        };

        closeBtn.addEventListener('click', closeModal);
        modal.addEventListener('click', (e) => {
            if (e.target === modal) closeModal();
        });

        window.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && modal.classList.contains('active')) {
                closeModal();
            }
        });
    }

    createParticles() {
        const geometry = new THREE.BufferGeometry();
        const vertices = [];
        const count = 3000;

        for (let i = 0; i < count; i++) {
            const x = (Math.random() - 0.5) * 20;
            const y = (Math.random() - 0.5) * 20;
            const z = (Math.random() - 0.5) * 20;
            vertices.push(x, y, z);
        }

        geometry.setAttribute('position', new THREE.Float32BufferAttribute(vertices, 3));

        const material = new THREE.PointsMaterial({
            size: 0.015,
            color: 0x10b981,
            transparent: true,
            opacity: 0.4,
            blending: THREE.AdditiveBlending
        });

        this.points = new THREE.Points(geometry, material);
        this.scene.add(this.points);
    }

    handleMouse() {
        window.addEventListener('mousemove', (e) => {
            this.mouseX = (e.clientX / window.innerWidth - 0.5) * 0.5;
            this.mouseY = (e.clientY / window.innerHeight - 0.5) * 0.5;
        });
    }

    handleResize() {
        window.addEventListener('resize', () => {
            this.camera.aspect = window.innerWidth / window.innerHeight;
            this.camera.updateProjectionMatrix();
            this.renderer.setSize(window.innerWidth, window.innerHeight);
        });
    }

    animate() {
        requestAnimationFrame(this.animate.bind(this));

        if (this.points) {
            this.points.rotation.y += 0.001;
            this.points.rotation.x += 0.0005;

            // Subtle mouse interaction
            this.points.rotation.y += (this.mouseX - this.points.rotation.y) * 0.05;
            this.points.rotation.x += (this.mouseY - this.points.rotation.x) * 0.05;
        }

        this.renderer.render(this.scene, this.camera);
    }

    initScrollReveal() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('section').forEach(section => {
            observer.observe(section);
        });
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    new Portfolio3D();
});
