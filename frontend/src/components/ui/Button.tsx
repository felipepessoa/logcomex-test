import type {ButtonHTMLAttributes, ReactNode} from 'react'

interface ButtonProps extends ButtonHTMLAttributes<HTMLButtonElement> {
    children: ReactNode
    variant?: 'primary' | 'secondary'
    loading?: boolean
}

export function Button({
   children,
   variant = 'primary',
   loading = false,
   disabled,
   className = '',
   ...props
}: ButtonProps) {
    const base =
        'px-4 py-2 rounded-lg font-medium transition-colors disabled:opacity-50 disabled:cursor-not-allowed'
    const variants = {
        primary: 'bg-blue-600 text-white hover:bg-blue-700',
        secondary: 'bg-gray-200 text-gray-800 hover:bg-gray-300',
    }
    return (
        <button
            type="button"
            className={`${base} ${variants[variant]} ${className}`}
            disabled={disabled || loading}
            {...props}
        >
            {loading ? 'Carregando...' : children}
        </button>
    )
}