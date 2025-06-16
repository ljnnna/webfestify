const utils = {
    showNotification(
        message,
        type = "info",
        duration = 5000,
        isInteractive = false
    ) {
        // Remove existing notifications if interactive
        if (isInteractive) {
            document
                .querySelectorAll(".notification-alert")
                .forEach((n) => n.remove());
        }

        const notification = document.createElement("div");
        notification.className = `notification-alert fixed top-20 right-4 z-50 max-w-sm p-4 rounded-lg shadow-xl transform transition-all duration-500 ease-out ${
            type === "success"
                ? "bg-gradient-to-r from-green-500 to-green-600 text-white"
                : type === "error"
                ? "bg-gradient-to-r from-red-500 to-red-600 text-white"
                : type === "warning"
                ? "bg-gradient-to-r from-yellow-500 to-orange-500 text-white"
                : "bg-gradient-to-r from-blue-500 to-blue-600 text-white"
        } animate-slide-in`;

        const iconMap = {
            success: "fas fa-check-circle",
            error: "fas fa-exclamation-triangle",
            warning: "fas fa-exclamation-circle",
            info: "fas fa-info-circle",
        };

        notification.innerHTML = `
            <div class="flex items-start gap-3">
                <div class="flex-shrink-0 mt-0.5">
                    <i class="${iconMap[type]} text-lg"></i>
                </div>
                <div class="flex-1">
                    <div class="text-sm font-semibold mb-1">${this.getNotificationTitle(
                        type
                    )}</div>
                    <div class="text-sm opacity-90 leading-relaxed">${message}</div>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" 
                        class="flex-shrink-0 ml-2 text-white hover:text-gray-200 transition-colors">
                    <i class="fas fa-times text-sm"></i>
                </button>
            </div>
            ${
                isInteractive
                    ? `
                <div class="mt-3 pt-3 border-t border-white border-opacity-30">
                    <div class="flex gap-2">
                        <button onclick="this.parentElement.parentElement.parentElement.remove()" 
                                class="flex-1 bg-white bg-opacity-20 hover:bg-opacity-30 text-white text-xs font-medium py-2 px-3 rounded-md transition-colors">
                            Dismiss
                        </button>
                        ${
                            type === "warning"
                                ? `
                            <button onclick="dateManager.showDateHelper(); this.parentElement.parentElement.parentElement.remove()" 
                                    class="flex-1 bg-white text-gray-800 hover:bg-gray-100 text-xs font-medium py-2 px-3 rounded-md transition-colors">
                                Fix Dates
                            </button>
                        `
                                : ""
                        }
                    </div>
                </div>
            `
                    : ""
            }
        `;

        // Add CSS animation
        const style = document.createElement("style");
        style.textContent = `
            @keyframes slideIn {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            .animate-slide-in {
                animation: slideIn 0.5s ease-out;
            }
            .notification-alert {
                backdrop-filter: blur(10px);
            }
        `;
        document.head.appendChild(style);

        document.body.appendChild(notification);

        // Auto remove after duration
        if (duration > 0) {
            setTimeout(() => {
                notification.style.transform = "translateX(100%)";
                notification.style.opacity = "0";
                setTimeout(() => notification.remove(), 300);
            }, duration);
        }
    },

    getNotificationTitle(type) {
        const titles = {
            success: "Success!",
            error: "Error!",
            warning: "Warning!",
            info: "Information",
        };
        return titles[type] || "Notification";
    },

    formatPrice(price) {
        return new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR",
            minimumFractionDigits: 0,
        }).format(price);
    },

    getTodayDate() {
        return new Date().toISOString().split("T")[0];
    },

    addDaysToDate(dateString, days) {
        if (!dateString || isNaN(new Date(dateString))) {
            console.warn("Invalid dateString passed:", dateString);
            return null;
        }

        const date = new Date(dateString);
        date.setDate(date.getDate() + days);
        return date.toISOString().split("T")[0];
    },

    formatDate(date) {
        if (!date || isNaN(new Date(date))) {
            return "Invalid Date";
        }

        return new Date(date).toLocaleDateString("id-ID", {
            year: "numeric",
            month: "long",
            day: "numeric",
        });
    },

    formatToDateString(date) {
        if (!(date instanceof Date) || isNaN(date.getTime())) return "";
        return date.toISOString().split("T")[0];
    },
};
