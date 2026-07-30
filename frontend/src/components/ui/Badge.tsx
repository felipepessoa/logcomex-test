const typeColors: Record<string, string> = {
    fire: 'bg-red-500',
    water: 'bg-blue-500',
    grass: 'bg-green-500',
    electric: 'bg-yellow-400 text-yellow-900',
    poison: 'bg-purple-500',
    normal: 'bg-gray-400',
    fighting: 'bg-red-700',
    flying: 'bg-indigo-400',
    ground: 'bg-yellow-700',
    rock: 'bg-yellow-800',
    bug: 'bg-lime-500',
    ghost: 'bg-purple-700',
    steel: 'bg-gray-500',
    psychic: 'bg-pink-500',
    ice: 'bg-cyan-400',
    dragon: 'bg-indigo-700',
    dark: 'bg-gray-800',
    fairy: 'bg-pink-300',
}
interface BadgeProps {
    children: string
}
export function Badge({ children }: BadgeProps) {
    const color = typeColors[children] ?? 'bg-gray-500'
    return (
        <span
            className={`${color} text-white text-xs font-medium px-2 py-0.5 rounded-full capitalize`}
        >
        {children}
      </span>
    )
}