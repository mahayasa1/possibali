<style>
[x-cloak]{
    display:none !important;
}

/* ========================================
   ACCESSIBILITY PANEL
======================================== */

.accessibility-floating{
    position:fixed;
    right:24px;
    bottom:24px;
    width:64px;
    height:64px;
    border:none;
    border-radius:50%;
    cursor:pointer;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:22px;
    color:#fff;

    background:linear-gradient(
        135deg,
        var(--ocean-teal),
        var(--ocean-bright)
    );

    box-shadow:
        0 10px 30px rgba(0,0,0,.35),
        var(--shadow-glow);

    transition:.3s ease;
    z-index:99999;
}

.accessibility-floating:hover{
    transform:translateY(-3px) scale(1.05);
}

.accessibility-panel{
    position:fixed;
    top:0;
    right:0;
    width:420px;
    max-width:100%;
    height:100vh;

    background:rgba(10,22,40,.96);
    backdrop-filter:blur(20px);

    border-left:1px solid var(--glass-border);

    z-index:99998;

    display:flex;
    flex-direction:column;
}

.accessibility-header{
    padding:22px;
    border-bottom:1px solid var(--glass-border);
}

.accessibility-title{
    font-size:1.3rem;
    font-weight:700;
    color:white;
}

.accessibility-subtitle{
    font-size:.85rem;
    color:var(--text-muted);
}

.accessibility-body{
    flex:1;
    overflow-y:auto;
    padding:20px;
}

.acc-section{
    margin-bottom:28px;
}

.acc-title{
    font-size:.8rem;
    text-transform:uppercase;
    letter-spacing:.1em;
    color:var(--ocean-foam);
    margin-bottom:12px;
}

.acc-grid{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:10px;
}

.acc-btn{
    min-height:70px;

    border:1px solid var(--glass-border);
    border-radius:12px;

    background:var(--glass-bg);

    color:#fff;

    cursor:pointer;

    display:flex;
    align-items:center;
    justify-content:center;

    text-align:center;

    transition:.25s;
}

.acc-btn:hover{
    border-color:var(--ocean-bright);
    transform:translateY(-2px);
}

.acc-btn.active{
    background:linear-gradient(
        135deg,
        var(--ocean-teal),
        var(--ocean-bright)
    );

    border-color:transparent;
}

.acc-close{
    width:36px;
    height:36px;
    border:none;
    border-radius:50%;
    cursor:pointer;
    color:white;
    background:rgba(255,255,255,.08);
}

.acc-close:hover{
    background:rgba(255,255,255,.15);
}

.acc-reset{
    width:100%;
    padding:14px;
    border:none;
    border-radius:12px;
    cursor:pointer;

    background:linear-gradient(
        135deg,
        #dc2626,
        #ef4444
    );

    color:white;
    font-weight:600;
}

#bgDimmer{
    display:none;
    position:fixed;
    inset:0;
    background:rgba(0,0,0,.45);
    pointer-events:none;
    z-index:99990;
}

#readingMask{
    display:none;
    position:fixed;
    left:0;
    width:100%;
    height:120px;

    background:rgba(255,255,0,.12);

    pointer-events:none;

    z-index:99991;
}

/* ========================================
   ADHD MODE
======================================== */

body.adhd-mode *{

    line-height:2 !important;

    letter-spacing:1px !important;

    word-spacing:4px !important;

    transition:none !important;

    animation:none !important;

}

body.adhd-mode p,
body.adhd-mode li,
body.adhd-mode article,
body.adhd-mode span{

    max-width:75ch;

}

@media(max-width:768px){

    .accessibility-panel{
        width:100%;
    }

    .accessibility-floating{
        width:58px;
        height:58px;
        right:16px;
        bottom:16px;
    }

}
</style>

<div x-data="accessibilityMenu()" x-init="init()" x-cloak>

<button
    class="accessibility-floating"
    @click="open=!open"
>
    <i class="fa-solid fa-universal-access"></i>
</button>

<div
    x-show="open"
    x-transition
    class="accessibility-panel"
>

    <div class="accessibility-header">

        <div class="flex justify-between items-center">

            <div>
                <div class="accessibility-title">
                    Accessibility
                </div>

                <div class="accessibility-subtitle">
                    Accessibility Tools
                </div>
            </div>

            <button
                class="acc-close"
                @click="open=false"
            >
                ✕
            </button>

        </div>

    </div>

    <div class="accessibility-body">

    <!-- ADHD MODE -->
<div class="acc-section">

    <div class="acc-title">
        ADHD Mode
    </div>

    <div class="acc-grid">

        <button
            class="acc-btn"
            :class="{ 'active': adhdActive }"
            @click="toggleADHD()"
        >
            <div>
                <i class="fa-solid fa-brain"></i>
                <span class="block mt-2">
                    Enable ADHD Mode
                </span>
            </div>
        </button>

    </div>

</div>

        <!-- FONT -->
<div class="acc-section">

    <div class="acc-title">
        Font Size
    </div>

    <div class="acc-grid">

        <button
            class="acc-btn"
            @click="fontIncrease()"
        >
            Bigger Text
        </button>

        <button
            class="acc-btn"
            @click="fontDecrease()"
        >
            Smaller Text
        </button>

    </div>

</div>
<!-- ALIGNMENT -->
<div class="acc-section">

    <div class="acc-title">
        Text Alignment
    </div>

    <div class="acc-grid">

        <button
            class="acc-btn"
            @click="setAlign('left')"
        >
            Left
        </button>

        <button
            class="acc-btn"
            @click="setAlign('center')"
        >
            Center
        </button>

        <button
            class="acc-btn"
            @click="setAlign('right')"
        >
            Right
        </button>

        <button
            class="acc-btn"
            @click="setAlign('justify')"
        >
            Justify
        </button>

    </div>

</div>

<!-- LINE HEIGHT -->
<div class="acc-section">

    <div class="acc-title">
        Line Height
    </div>

    <div class="acc-grid">

        <button
            class="acc-btn"
            @click="setLineHeight(1.3)"
        >
            Tight
        </button>

        <button
            class="acc-btn"
            @click="setLineHeight(1.8)"
        >
            Normal
        </button>

        <button
            class="acc-btn"
            @click="setLineHeight(2)"
        >
            Wide
        </button>

    </div>

</div>

<!-- LETTER SPACING -->
<div class="acc-section">

    <div class="acc-title">
        Letter Spacing
    </div>

    <div class="acc-grid">

        <button
            class="acc-btn"
            @click="setSpacing('0px')"
        >
            Normal
        </button>

        <button
            class="acc-btn"
            @click="setSpacing('1px')"
        >
            Medium
        </button>

        <button
            class="acc-btn"
            @click="setSpacing('2px')"
        >
            Wide
        </button>

    </div>

</div>

<!-- VISUAL TOOLS -->
<div class="acc-section">

    <div class="acc-title">
        Visual Tools
    </div>

    <div class="acc-grid">

        <button
            class="acc-btn"
            :class="{ 'active' : contrast }"
            @click="toggleContrast()"
        >
            High Contrast
        </button>

        <button
            class="acc-btn"
            :class="{ 'active' : saturation }"
            @click="toggleSaturation()"
        >
            Low Saturation
        </button>

        <button
            class="acc-btn"
            :class="{ 'active' : dyslexia }"
            @click="toggleDyslexia()"
        >
            Dyslexia Font
        </button>

        <button
            class="acc-btn"
            :class="{ 'active' : mask }"
            @click="toggleMask()"
        >
            Reading Mask
        </button>

    </div>

</div>

<!-- RESET -->
<div class="acc-section">

    <button
        class="acc-reset"
        @click="resetAll()"
    >
        Reset All Settings
    </button>

</div>

</div>
<!-- END BODY -->

</div>
<!-- END PANEL -->

<div id="bgDimmer"></div>
<div id="readingMask"></div>

</div>

<script>
function accessibilityMenu(){

    return {

        open:false,
        showFloating:true,

        adhdActive:false,

        init(){

            const data = JSON.parse(
                localStorage.getItem('accessibility')
            );

            if(!data) return;

            /* FONT */
            this.font.scale =
                data.fontScale || 1;

            document.documentElement.style.fontSize =
                (this.font.scale * 16) + 'px';

            /* VISUAL */
            this.visual.saturateActive =
                data.saturateActive || false;

            this.visual.contrastActive =
                data.contrastActive || false;

            this.visual.apply();

            /* LAYOUT */
            this.layout.alignMode =
                data.alignMode || '';

            this.layout.lineHeightMode =
                data.lineHeightMode || '';

            this.layout.spacingMode =
                data.spacingMode || '';

            document.body.style.textAlign =
                this.layout.alignMode;

            document.body.style.lineHeight =
                this.layout.lineHeightMode;

            document.body.style.letterSpacing =
                this.layout.spacingMode;

            /* DYSLEXIA */
            this.assist.dyslexia =
                data.dyslexia || false;

            if(this.assist.dyslexia){

                document.body.style.fontFamily =
                    'OpenDyslexic,sans-serif';

            }

            /* MASK */
            this.cursor.active =
                data.mask || false;

            if(this.cursor.active){

                setTimeout(() => {

                    this.cursor.enable();

                },100);

            }

            /* ADHD */
            this.adhdActive =
                data.adhdActive || false;

            if(this.adhdActive){

                setTimeout(() => {

                    this.enableADHD();

                },100);

            }

        },

        save(){

            localStorage.setItem(
                'accessibility',
                JSON.stringify({

                    fontScale:
                        this.font.scale,

                    saturateActive:
                        this.visual.saturateActive,

                    contrastActive:
                        this.visual.contrastActive,

                    alignMode:
                        this.layout.alignMode,

                    lineHeightMode:
                        this.layout.lineHeightMode,

                    spacingMode:
                        this.layout.spacingMode,

                    dyslexia:
                        this.assist.dyslexia,

                    mask:
                        this.cursor.active,

                    adhdActive:
                        this.adhdActive

                })
            );

        },

        /* ==================================
           FONT
        ================================== */

        font:{

            scale:1,

            increase(){

                this.scale =
                    Math.min(
                        this.scale + 0.1,
                        2
                    );

                document.documentElement.style.fontSize =
                    (this.scale * 16) + 'px';
            },

            decrease(){

                this.scale =
                    Math.max(
                        this.scale - 0.1,
                        0.8
                    );

                document.documentElement.style.fontSize =
                    (this.scale * 16) + 'px';
            }

        },

        fontIncrease(){

            this.font.increase();

            this.save();

        },

        fontDecrease(){

            this.font.decrease();

            this.save();

        },

        /* ==================================
           VISUAL
        ================================== */

        visual:{

            saturateActive:false,
            contrastActive:false,

            apply(){

                let filters = [];

                if(this.saturateActive){

                    filters.push(
                        'saturate(40%)'
                    );

                }

                if(this.contrastActive){

                    filters.push(
                        'contrast(140%)'
                    );

                }

                document.documentElement.style.filter =
                    filters.join(' ');
            }

        },

        toggleContrast(){

            this.visual.contrastActive =
                !this.visual.contrastActive;

            this.visual.apply();

            this.save();

        },

        toggleSaturation(){

            this.visual.saturateActive =
                !this.visual.saturateActive;

            this.visual.apply();

            this.save();

        },

        /* ==================================
           LAYOUT
        ================================== */

        layout:{

            alignMode:'',
            lineHeightMode:'',
            spacingMode:''

        },

        setAlign(value){

            this.layout.alignMode =
                this.layout.alignMode === value
                ? ''
                : value;

            document.body.style.textAlign =
                this.layout.alignMode;

            this.save();

        },

        setLineHeight(value){

            this.layout.lineHeightMode =
                this.layout.lineHeightMode === value
                ? ''
                : value;

            document.body.style.lineHeight =
                this.layout.lineHeightMode;

            this.save();

        },

        setSpacing(value){

            this.layout.spacingMode =
                this.layout.spacingMode === value
                ? ''
                : value;

            document.body.style.letterSpacing =
                this.layout.spacingMode;

            this.save();

        },

        /* ==================================
           DYSLEXIA
        ================================== */

        assist:{

            dyslexia:false

        },

        toggleDyslexia(){

            this.assist.dyslexia =
                !this.assist.dyslexia;

            document.body.style.fontFamily =
                this.assist.dyslexia
                    ? 'OpenDyslexic,sans-serif'
                    : '';

            this.save();

        },

        /* ==================================
           MASK
        ================================== */

        cursor:{

            active:false,

            enable(){

                const mask =
                    document.getElementById(
                        'readingMask'
                    );

                const dimmer =
                    document.getElementById(
                        'bgDimmer'
                    );

                if(mask){

                    mask.style.display='block';

                }

                if(dimmer){

                    dimmer.style.display='block';

                }

                window.onmousemove =
                    (e)=>{

                    if(mask){

                        mask.style.top =
                            (e.clientY - 35)+'px';

                    }

                };

            }

        },

        toggleMask(){

            this.cursor.active =
                !this.cursor.active;

            const mask =
                document.getElementById(
                    'readingMask'
                );

            const dimmer =
                document.getElementById(
                    'bgDimmer'
                );

            if(this.cursor.active){

                this.cursor.enable();

            }else{

                if(mask){

                    mask.style.display='none';

                }

                if(dimmer){

                    dimmer.style.display='none';

                }

                window.onmousemove = null;

            }

            this.save();

        },

        /* ==================================
           ADHD
        ================================== */

        toggleADHD(){

            this.adhdActive =
                !this.adhdActive;

            if(this.adhdActive){

                this.enableADHD();

            }else{

                this.disableADHD();

            }

            this.save();

        },

        enableADHD(){

            const mask =
                document.getElementById(
                    'readingMask'
                );

            const dimmer =
                document.getElementById(
                    'bgDimmer'
                );

            document.body.classList.add(
                'adhd-mode'
            );

            if(mask){

                mask.style.display='block';

            }

            if(dimmer){

                dimmer.style.display='block';

            }

            window.onmousemove =
                (e)=>{

                if(mask){

                    mask.style.top =
                        (e.clientY - 35)+'px';

                }

            };

        },

        disableADHD(){

            const mask =
                document.getElementById(
                    'readingMask'
                );

            const dimmer =
                document.getElementById(
                    'bgDimmer'
                );

            document.body.classList.remove(
                'adhd-mode'
            );

            if(mask){

                mask.style.display='none';

            }

            if(dimmer){

                dimmer.style.display='none';

            }

            window.onmousemove = null;

        },

        /* ==================================
           RESET
        ================================== */

        resetAll(){

            localStorage.removeItem(
                'accessibility'
            );

            document.documentElement.style.fontSize =
                '';

            document.documentElement.style.filter =
                '';

            document.body.style.textAlign =
                '';

            document.body.style.lineHeight =
                '';

            document.body.style.letterSpacing =
                '';

            document.body.style.fontFamily =
                '';

            document.body.classList.remove(
                'adhd-mode'
            );

            const mask =
                document.getElementById(
                    'readingMask'
                );

            const dimmer =
                document.getElementById(
                    'bgDimmer'
                );

            if(mask){

                mask.style.display='none';

            }

            if(dimmer){

                dimmer.style.display='none';

            }

            window.onmousemove = null;

            location.reload();

        }

    };

}
</script>