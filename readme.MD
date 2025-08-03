# CampusConnect 🎓

<div align="center">
  <img src="https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white" alt="HTML5" />
  <img src="https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white" alt="CSS3" />
  <img src="https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black" alt="JavaScript" />
  <img src="https://img.shields.io/badge/Responsive-4285F4?style=for-the-badge&logo=googlechrome&logoColor=white" alt="Responsive" />
</div>

<div align="center">
  <h3>🌟 Your Ultimate Digital Campus Hub 🌟</h3>
  <p><em>Connecting students, enhancing campus life, one click at a time</em></p>
</div>

---

## 📖 About The Project

**CampusConnect** is a comprehensive digital platform designed to revolutionize campus life by bringing together all essential student services in one beautiful, intuitive interface. Built with modern web technologies, it serves as the central hub for campus events, club memberships, announcements, and memorable moments.

### ✨ Key Highlights

- 🎯 **Smart Dashboard** - Personalized overview of campus activities
- 🎉 **Event Discovery** - Never miss exciting campus events
- 👥 **Club Management** - Easy club joining and participation
- 📢 **Real-time Announcements** - Stay updated with important information
- 📸 **Memory Gallery** - Capture and share campus moments
- 🌙 **Dark/Light Theme** - Seamless theme switching
- 📱 **Fully Responsive** - Perfect on all devices

---

## 🏗️ Project Structure

```
CampusConnect/
├── 📄 index.html          # Homepage with hero section
├── 📊 dashboard.html      # Student dashboard
├── 🎉 eventPlanner.html   # Events and activities
├── 🎭 clubs.html          # Club directory
├── 📢 announcements.html  # Campus announcements
├── 📸 memories.html       # Photo gallery
├── 📝 register.html       # Student registration
├── 📞 contact.html        # Contact information
├── ❓ faq.html            # Frequently asked questions
├── ℹ️ about.html          # About the platform
├── 🎨 style.css          # Main stylesheet
├── ⚡ main.js            # JavaScript functionality
├── 🌙 theme.js           # Theme management
└── 🖼️ img1-12.jpg        # Campus memory images
```

---

## 🚀 Features Overview

### 🏠 **Homepage**
- Stunning hero section with gradient animations
- Feature showcase with hover effects
- Statistics counter with animated numbers
- Call-to-action buttons with smooth transitions

### 📊 **Dashboard**
- Personalized student statistics
- Recent activity timeline
- Quick action buttons
- Beautiful data visualization

### 🎉 **Events**
- Interactive event planner
- Event categorization and filtering
- Registration capabilities
- Calendar integration ready

### 🎭 **Clubs**
- Comprehensive club directory
- Club statistics and member counts
- Tag-based categorization
- Easy join functionality

### 📢 **Announcements**
- Real-time campus updates
- Categorized announcements
- Search and filter options
- Priority highlighting

### 📸 **Memories**
- Interactive image slider
- Full-screen image popup
- Auto-play functionality
- Responsive gallery grid

---

## 🎨 Design Features

### 🌈 **Visual Excellence**
- **Modern UI/UX** - Clean, intuitive interface design
- **Gradient Backgrounds** - Beautiful color transitions
- **Glassmorphism Effects** - Modern blur and transparency
- **Smooth Animations** - 60fps CSS animations
- **Responsive Design** - Mobile-first approach

### 🎭 **Interactive Elements**
- **Hover Animations** - Engaging micro-interactions
- **Loading Animations** - Smooth page transitions
- **Form Validations** - Real-time input feedback
- **Theme Switching** - Instant dark/light mode toggle

### 🎯 **Accessibility**
- **Semantic HTML** - Screen reader friendly
- **Keyboard Navigation** - Full keyboard support
- **Color Contrast** - WCAG compliant colors
- **Responsive Images** - Optimized for all screens

---

## 💻 Technologies Used

### Frontend Stack
- **HTML5** - Semantic markup and structure
- **CSS3** - Advanced styling and animations
  - Flexbox & Grid layouts
  - Custom properties (CSS variables)
  - Keyframe animations
  - Media queries for responsiveness
- **Vanilla JavaScript** - Interactive functionality
  - DOM manipulation
  - Event handling
  - Local storage for theme persistence

### Design Patterns
- **Mobile-First Design** - Responsive from ground up
- **Component-Based CSS** - Reusable style components
- **Progressive Enhancement** - Works without JavaScript
- **Graceful Degradation** - Fallbacks for older browsers

---

## 🛠️ Installation & Setup

### Quick Start

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/campusconnect.git
   cd campusconnect
   ```

2. **Open in browser**
   ```bash
   # Simply open index.html in your preferred browser
   # Or use a local server for better experience
   python -m http.server 8000
   # Then visit http://localhost:8000
   ```

3. **That's it!** 🎉 No build process or dependencies required.

### Development Setup

For the best development experience:

```bash
# Use Live Server extension in VS Code
# Or use any local development server
npx http-server .
```

---

## 📱 Browser Support

| Browser | Support |
|---------|---------|
| Chrome  | ✅ Full |
| Firefox | ✅ Full |
| Safari  | ✅ Full |
| Edge    | ✅ Full |
| Opera   | ✅ Full |

---

## 🎯 Usage Examples

### Theme Switching
```javascript
// Toggle between light and dark themes
function toggleTheme() {
  const body = document.body;
  const currentTheme = body.getAttribute('data-theme');
  body.setAttribute('data-theme', currentTheme === 'light' ? 'dark' : 'light');
}
```

### Interactive Gallery
```javascript
// Open image in full-screen popup
function openPopup(imgSrc) {
  const popup = document.getElementById('popup');
  const popupImg = document.getElementById('popup-img');
  popupImg.src = imgSrc;
  popup.style.display = 'flex';
}
```

---

## 🎨 Customization

### Color Scheme
The project uses CSS custom properties for easy theme customization:

```css
:root {
  --accent-color: #6c63ff;
  --hover-color: #48c6ef;
  --text-color: #333333;
  --bg-color: #ffffff;
}
```

### Adding New Sections
1. Create HTML structure in respective file
2. Add styling in [`style.css`](style.css)
3. Add interactivity in [`main.js`](main.js)

---

## 🤝 Contributing

We welcome contributions! Here's how you can help:

### 🐛 Bug Reports
- Use the issue tracker
- Include browser and version
- Provide reproduction steps

### ✨ Feature Requests
- Describe the feature clearly
- Explain the use case
- Consider implementation complexity

### 🔧 Pull Requests
1. Fork the repository
2. Create feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add AmazingFeature'`)
4. Push to branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

---

## 📈 Roadmap

### Phase 1 ✅ (Completed)
- [x] Basic website structure
- [x] Responsive design
- [x] Theme switching
- [x] Interactive components

### Phase 2 🚧 (In Progress)
- [ ] Backend integration
- [ ] User authentication
- [ ] Database connectivity
- [ ] Real-time notifications

### Phase 3 📋 (Planned)
- [ ] Mobile app version
- [ ] API development
- [ ] Advanced analytics
- [ ] Integration with campus systems

---

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

```
MIT License

Copyright (c) 2025 Rutvi Shah

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.
```

---

## 👤 Author

**Rutvi Shah**
- 💼 Role: Full Stack Developer & UI/UX Designer
- 🎓 Student passionate about creating digital solutions
- 💡 Vision: Making campus life simpler, smarter, and more connected

---

## 🙏 Acknowledgments

- 🎨 **Design Inspiration** - Modern UI/UX trends and best practices
- 🌈 **Color Palettes** - Carefully curated for accessibility and aesthetics
- 📱 **Responsive Design** - Mobile-first approach for all users
- ♿ **Accessibility** - Inclusive design principles
- 🚀 **Performance** - Optimized for speed and efficiency

---

## 📞 Support

Need help or have questions?

- 📧 **Email**: support@campusconnect.in
- 🐛 **Issues**: [GitHub Issues](https://github.com/yourusername/campusconnect/issues)
- 💬 **Discussions**: [GitHub Discussions](https://github.com/yourusername/campusconnect/discussions)

---

<div align="center">
  <h3>🌟 Star this repository if you found it helpful! 🌟</h3>
  <p>Made with ❤️ by Rutvi Shah</p>
  <p><em>© 2025 CampusConnect. All rights reserved.</em></p>
</div>

---

### 📊 Project Stats

<div align="center">
  <img src="https://img.shields.io/github/stars/yourusername/campusconnect?style=social" alt="Stars" />
  <img src="https://img.shields.io/github/forks/yourusername/campusconnect?style=social" alt="Forks" />
  <img src="https://img.shields.io/github/watchers/yourusername/campusconnect?style=social" alt="Watchers" />
</div>

<div align="center">
  <img src="https://img.shields.io/github/repo-size/yourusername/campusconnect" alt="Repo Size" />
  <img src="https://img.shields.io/github/languages/count/yourusername/campusconnect" alt="Languages" />
  <img src="https://img.shields.io/github/last-commit/yourusername/campusconnect" alt="Last Commit" />
</div>