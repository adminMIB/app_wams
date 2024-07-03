export default {
  updateTooltip(el, { value, modifiers }) {
    if (typeof value === "string") {
      el.setAttribute("data-v-tooltip", value);

      if (modifiers.arrow) {
        el.style.setProperty("--v-tooltip-arrow-display", "inline");
      }
    } else if (typeof value === "object" && value !== null) {
      // Ensure value is an object and not null
      if (value.text) {
        el.setAttribute("data-v-tooltip", value.text);
      }
      if (value.displayArrow || modifiers.arrow) {
        const targetEl = value.global ? document.documentElement : el;
        targetEl.style.setProperty("--v-tooltip-arrow-display", "inline");
      }
      if (value.theme) {
        const targetEl = value.global ? document.documentElement : el;
        for (const [key, val] of Object.entries(value.theme)) {
          if (key === "placement") {
            switch (val) {
              case "top":
                targetEl.style.setProperty("--v-tooltip-left", "50%");
                targetEl.style.setProperty("--v-tooltip-top", "0%");
                targetEl.style.setProperty(
                  "--v-tooltip-translate",
                  "translate(-50%, -110%)"
                );
                if (value.displayArrow || modifiers.arrow) {
                  targetEl.style.setProperty(
                    "--v-tooltip-arrow-border-color",
                    "var(--v-tooltip-background-color) transparent transparent transparent"
                  );
                  targetEl.style.setProperty(
                    "--v-tooltip-arrow-top",
                    "calc(var(--v-tooltip-top) - var(--v-tooltip-top-offset) + 8px)"
                  );
                }
                break;
              case "bottom":
                targetEl.style.setProperty("--v-tooltip-left", "50%");
                targetEl.style.setProperty("--v-tooltip-top", "100%");
                targetEl.style.setProperty(
                  "--v-tooltip-translate",
                  "translate(-50%, 10%)"
                );
                if (value.displayArrow || modifiers.arrow) {
                  targetEl.style.setProperty(
                    "--v-tooltip-arrow-border-color",
                    "transparent transparent var(--v-tooltip-background-color) transparent"
                  );
                  targetEl.style.setProperty(
                    "--v-tooltip-arrow-top",
                    "calc(var(--v-tooltip-top) - var(--v-tooltip-top-offset) - 7px)"
                  );
                }
                break;
              case "left":
                targetEl.style.setProperty("--v-tooltip-left", "0%");
                targetEl.style.setProperty("--v-tooltip-top", "50%");
                targetEl.style.setProperty(
                  "--v-tooltip-translate",
                  "translate(-110%, -50%)"
                );
                if (value.displayArrow || modifiers.arrow) {
                  targetEl.style.setProperty(
                    "--v-tooltip-arrow-border-color",
                    "transparent transparent transparent var(--v-tooltip-background-color)"
                  );
                  targetEl.style.setProperty(
                    "--v-tooltip-arrow-top",
                    "calc(var(--v-tooltip-top)"
                  );
                  targetEl.style.setProperty(
                    "--v-tooltip-arrow-left",
                    "calc( var(--v-tooltip-left) - var(--v-tooltip-left-offset) + 1.5px)"
                  );
                }
                break;
              case "right":
                targetEl.style.setProperty("--v-tooltip-left", "100%");
                targetEl.style.setProperty("--v-tooltip-top", "50%");
                targetEl.style.setProperty(
                  "--v-tooltip-translate",
                  "translate(10%, -50%)"
                );
                if (value.displayArrow || modifiers.arrow) {
                  targetEl.style.setProperty(
                    "--v-tooltip-arrow-border-color",
                    "transparent var(--v-tooltip-background-color) transparent  transparent"
                  );
                  targetEl.style.setProperty(
                    "--v-tooltip-arrow-top",
                    "calc(var(--v-tooltip-top)"
                  );
                  targetEl.style.setProperty(
                    "--v-tooltip-arrow-left",
                    "calc( var(--v-tooltip-left) - var(--v-tooltip-left-offset) - 2px)"
                  );
                }
                break;
              default:
                break;
            }
          } else if (key === "offset" && !value.global) {
            for (const direction of val) {
              if (direction === "left") {
                targetEl.style.setProperty(
                  "--v-tooltip-left-offset",
                  `-${targetEl.scrollWidth - targetEl.clientWidth}px`
                );
              } else if (direction === "right") {
                targetEl.style.setProperty(
                  "--v-tooltip-left-offset",
                  `${targetEl.scrollWidth - targetEl.clientWidth}px`
                );
              } else if (direction === "top") {
                targetEl.style.setProperty(
                  "--v-tooltip-top-offset",
                  `-${targetEl.scrollHeight - targetEl.clientHeight}px`
                );
              } else if (direction === "bottom") {
                targetEl.style.setProperty(
                  "--v-tooltip-top-offset",
                  `${targetEl.scrollHeight - targetEl.clientHeight}px`
                );
              }
            }
          } else {
            targetEl.style.setProperty(`--v-tooltip-${key}`, val);
          }
        }
      }
    }
  },
  mounted(el, { value, dir, modifiers }) {
    if (
      (typeof value === "object" &&
        value !== null &&
        !value.global &&
        value.text) ||
      typeof value === "string"
    ) {
      el.classList.add("data-v-tooltip");
    }

    dir.updateTooltip(el, { value, modifiers });
  },
  updated(el, { value, dir, modifiers }) {
    dir.updateTooltip(el, { value, modifiers });
  },
};
