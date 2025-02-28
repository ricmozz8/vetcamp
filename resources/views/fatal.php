<!DOCTYPE html>
<html lang="en">
<?php
require_once __DIR__ . '/partials/header.php';
?>
<body>
<style>
    .all-centered {
        max-width: 600px;
        margin: auto;
        text-align: center;
        padding: 19dvh 0;
        user-select: none;

    }

    .fatal-icon {
        width: 100px;
    }

    .all-centered h3 {
        font-size: 5em;
        font-weight: bold;
        margin: 0;
    }

    .all-centered h4 {
        font-size: 2em;
    }

    .all-centered p {
        font-size: 1em;
        margin: 1em 0;
    }

    .small-reason {
        width: 20px;
    }

    .centerme {
        margin-top: 15dvh;
        justify-content: center;
        text-align: left;
        text-wrap: nowrap;

    }

    .centerme p {
        font-family: monospace !important;
        user-select: all !important;

    }

</style>
<!--- Define your structure here --->

<div class="all-centered">
    <div class="fatal-icon" style="margin: 1em auto;">
        <svg width="100%" height="100%" viewBox="0 0 294 305"  xmlns="http://www.w3.org/2000/svg"
             xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve"
             style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
            <g transform="matrix(1,0,0,1,-1299,-670)">
                <g id="fatal-icon" transform="matrix(4.09704,0,0,4.09704,-6659.22,-1351.41)">
                    <path d="M1981.12,567.775L1942.62,567.775L1942.62,498.669L1962.57,518.618L1962.57,493.42L1991.13,521.978L2013.97,521.978C2013.72,523.14 2013.43,524.288 2013.1,525.418C2013.05,525.595 2013,525.771 2012.94,525.946C2012.36,527.855 2011.67,529.716 2010.87,531.521C2009.85,533.832 2008.66,536.052 2007.31,538.164C2004.09,543.22 1999.99,547.659 1995.21,551.261C1993,552.928 1990.65,554.416 1988.18,555.702C1985.96,556.857 1983.65,557.85 1981.25,558.665C1981.21,558.68 1981.16,558.695 1981.12,558.71L1981.12,567.775ZM1974.7,530.598L1970.71,534.589L1974.3,538.185L1978.3,534.194L1982.29,538.185L1985.88,534.589L1981.89,530.598L1985.88,526.606L1982.29,523.01L1978.3,527.001L1974.3,523.01L1970.71,526.606L1974.7,530.598Z"/>
                </g>
            </g>
        </svg>
    </div>
    <h3>¡Oh no!</h3>
    <h4>Nos hemos encontrado con un problema</h4>

    <p>No te preocupes, no hace falta que nos lo reportes, lo hemos notado y nos encontramos trabajando en el asunto. Lo
        resolveremos en breve.</p>

    <div class="flex-min centerme">
        <img class="small-reason" src="/<?= asset('/logo/svg/code-nd00.svg') ?>" alt="">
        <strong>Datos técnicos:</strong>
        <?php if ($reason === 'disk') { ?>
            <p>Could not ensure byte allocation on current server disk, please free or move the current location.
            </p>
        <?php } ?>
    </div>
</div>
</body>
</html>