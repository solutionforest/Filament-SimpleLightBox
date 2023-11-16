window.SimpleImageLightBox={open(i){i.preventDefault();let o=i.target.src,e=document.createElement("div");e.innerHTML=`<div id="SimpleImageLightBox"
                    @keydown.escape.window="document.querySelector('#SimpleImageLightBox').remove()"
                    class="fixed inset-0 flex items-center justify-center p-4 bg-black/50 bg-opacity-75"
                    style="z-index: 10000;"
                    >
                    <div class="relative bg-white max-h-full max-w-2xl p-6 mx-auto rounded shadow" onclick="event.stopPropagation()">
                        <img src="${o}" alt="Lightbox image" class="object-cover w-full h-full rounded" />
                        <button class="absolute p-2 m-2 text-white rounded-full focus:outline-none" style="top:0; right:0" >
                        \u2716\uFE0F
                        </button>
                    </div>
                    </div>
                `,e.addEventListener("click",()=>this.close()),e.querySelector("button").addEventListener("click",t=>{t.stopPropagation(),this.close()}),e.querySelector("div").addEventListener("keydown",t=>{t.key==="Escape"&&this.close()}),this.lightboxDiv=e,document.body.appendChild(e)},close(){this.lightboxDiv.remove()}};
