const canvas = document.createElement('canvas');
canvas.classList.add('matrix-bg');
document.body.appendChild(canvas);
const ctx = canvas.getContext('2d');

canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

const matrix = "ABCDEFGHIJKLMNOPQRSTUVWXYZ123456789@#$%^&*()*&^%";
const characters = matrix.split("");
const fontSize = 14;
const columns = canvas.width/fontSize;
const drops = [];

for(let x = 0; x < columns; x++) {
    drops[x] = 1;
}

function drawMatrix() {
    ctx.fillStyle = "rgba(0, 0, 0, 0.05)";
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    
    ctx.fillStyle = "#0F0";
    ctx.font = fontSize + "px monospace";
    
    for(let i = 0; i < drops.length; i++) {
        const text = characters[Math.floor(Math.random()*characters.length)];
        ctx.fillText(text, i*fontSize, drops[i]*fontSize);
        
        if(drops[i]*fontSize > canvas.height && Math.random() > 0.975)
            drops[i] = 0;
        
        drops[i]++;
    }
}

setInterval(drawMatrix, 35);
