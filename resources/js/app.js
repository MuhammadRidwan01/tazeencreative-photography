import "./bootstrap"
import Alpine from "alpinejs"

// Initialize Alpine.js
window.Alpine = Alpine
Alpine.start()

// Smooth scrolling for anchor links
document.addEventListener("DOMContentLoaded", () => {
  // Smooth scroll for navigation links
  const links = document.querySelectorAll('a[href^="#"]')
  links.forEach((link) => {
    link.addEventListener("click", function (e) {
      e.preventDefault()
      const target = document.querySelector(this.getAttribute("href"))
      if (target) {
        target.scrollIntoView({
          behavior: "smooth",
          block: "start",
        })
      }
    })
  })

  // Lazy loading for images
  const images = document.querySelectorAll("img[data-src]")
  const imageObserver = new IntersectionObserver((entries, observer) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        const img = entry.target
        img.src = img.dataset.src
        img.classList.remove("opacity-0")
        img.classList.add("opacity-100")
        observer.unobserve(img)
      }
    })
  })

  images.forEach((img) => imageObserver.observe(img))

  // Portfolio filter functionality
  const filterButtons = document.querySelectorAll("[data-filter]")
  const portfolioItems = document.querySelectorAll("[data-category]")

  filterButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const filter = this.dataset.filter

      // Update active button
      filterButtons.forEach((btn) => btn.classList.remove("bg-black", "text-white"))
      filterButtons.forEach((btn) => btn.classList.add("bg-gray-200", "text-gray-700"))
      this.classList.remove("bg-gray-200", "text-gray-700")
      this.classList.add("bg-black", "text-white")

      // Filter items
      portfolioItems.forEach((item) => {
        if (filter === "all" || item.dataset.category === filter) {
          item.style.display = "block"
          item.classList.add("animate-fade-in")
        } else {
          item.style.display = "none"
        }
      })
    })
  })

  // Lightbox functionality
  const lightboxTriggers = document.querySelectorAll("[data-lightbox]")
  lightboxTriggers.forEach((trigger) => {
    trigger.addEventListener("click", function (e) {
      e.preventDefault()
      const src = this.dataset.lightbox || this.src || this.href
      window.openLightbox(src)
    })
  })

  // Form validation and submission
  const forms = document.querySelectorAll("form[data-ajax]")
  forms.forEach((form) => {
    form.addEventListener("submit", function (e) {
      e.preventDefault()

      const formData = new FormData(this)
      const submitButton = this.querySelector('button[type="submit"]')
      const originalText = submitButton.textContent

      // Show loading state
      submitButton.disabled = true
      submitButton.innerHTML = '<span class="loading"></span> Processing...'

      fetch(this.action, {
        method: "POST",
        body: formData,
        headers: {
          "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
        },
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            window.showNotification("Success!", "success")
            this.reset()
          } else {
            window.showNotification(data.message || "An error occurred", "error")
          }
        })
        .catch((error) => {
          window.showNotification("An error occurred. Please try again.", "error")
        })
        .finally(() => {
          submitButton.disabled = false
          submitButton.textContent = originalText
        })
    })
  })

  // Scroll animations
  const animateOnScroll = document.querySelectorAll("[data-animate]")
  const scrollObserver = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          const animation = entry.target.dataset.animate
          entry.target.classList.add(`animate-${animation}`)
          scrollObserver.unobserve(entry.target)
        }
      })
    },
    {
      threshold: 0.1,
    },
  )

  animateOnScroll.forEach((el) => scrollObserver.observe(el))
})

// Global functions
window.openLightbox = (src) => {
  const lightbox = document.getElementById("lightbox")
  const lightboxImg = document.getElementById("lightbox-img")

  if (lightbox && lightboxImg) {
    lightboxImg.src = src
    lightbox.classList.add("active")
    document.body.style.overflow = "hidden"
  }
}

window.closeLightbox = () => {
  const lightbox = document.getElementById("lightbox")
  if (lightbox) {
    lightbox.classList.remove("active")
    document.body.style.overflow = "auto"
  }
}

window.showNotification = (message, type = "info") => {
  const notification = document.createElement("div")
  notification.className = `fixed top-20 right-4 z-50 px-6 py-3 rounded-lg shadow-lg animate-slide-up ${
    type === "success" ? "bg-green-500" : type === "error" ? "bg-red-500" : "bg-blue-500"
  } text-white`
  notification.textContent = message

  document.body.appendChild(notification)

  setTimeout(() => {
    notification.remove()
  }, 5000)
}

// Chat functionality
window.initChat = () => {
  const chatForm = document.getElementById("chat-form")
  const chatContainer = document.getElementById("chat-container")
  const messageInput = document.getElementById("message-input")

  if (chatForm) {
    chatForm.addEventListener("submit", function (e) {
      e.preventDefault()

      const message = messageInput.value.trim()
      if (!message) return

      // Add message to chat immediately
      window.addMessageToChat(message, false)
      messageInput.value = ""

      // Send to server
      fetch(this.action, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
        },
        body: JSON.stringify({ message: message }),
      })
        .then((response) => response.json())
        .then((data) => {
          if (!data.success) {
            window.showNotification("Failed to send message", "error")
          }
        })
        .catch((error) => {
          window.showNotification("An error occurred", "error")
        })
    })
  }
}

window.addMessageToChat = (message, isAdmin = false) => {
  const chatContainer = document.getElementById("chat-container")
  if (!chatContainer) return

  const messageDiv = document.createElement("div")
  messageDiv.className = `mb-4 ${isAdmin ? "text-right" : "text-left"}`

  const messageContent = document.createElement("div")
  messageContent.className = `inline-block max-w-xs lg:max-w-md px-4 py-2 rounded ${
    isAdmin ? "bg-blue-500 text-white" : "bg-white border"
  }`

  const messageText = document.createElement("p")
  messageText.className = "text-sm"
  messageText.textContent = message

  const messageTime = document.createElement("p")
  messageTime.className = `text-xs mt-1 ${isAdmin ? "text-blue-100" : "text-gray-500"}`
  messageTime.textContent = new Date().toLocaleTimeString("id-ID", {
    hour: "2-digit",
    minute: "2-digit",
  })

  messageContent.appendChild(messageText)
  messageContent.appendChild(messageTime)
  messageDiv.appendChild(messageContent)
  chatContainer.appendChild(messageDiv)

  // Scroll to bottom
  chatContainer.scrollTop = chatContainer.scrollHeight
}

// Service comparison functionality
window.toggleComparison = () => {
  const comparison = document.getElementById("service-comparison")
  if (comparison) {
    comparison.classList.toggle("hidden")
  }
}

// FAQ functionality
window.toggleFAQ = (element) => {
  const content = element.nextElementSibling
  const icon = element.querySelector("svg")

  if (content.style.maxHeight) {
    content.style.maxHeight = null
    icon.style.transform = "rotate(0deg)"
  } else {
    content.style.maxHeight = content.scrollHeight + "px"
    icon.style.transform = "rotate(180deg)"
  }
}

// Initialize functions when DOM is loaded
document.addEventListener("DOMContentLoaded", () => {
  // Initialize chat if on chat page
  if (document.getElementById("chat-form")) {
    window.initChat()
  }

  // Initialize FAQ toggles
  const faqButtons = document.querySelectorAll("[data-faq-toggle]")
  faqButtons.forEach((button) => {
    button.addEventListener("click", function () {
      window.toggleFAQ(this)
    })
  })
})
