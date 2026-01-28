<tr id="course-{{ $course->id }}">
    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $course->title }}</td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $course->date->format('M d, Y') }}</td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${{ number_format($course->price, 2) }}</td>
    <td class="px-6 py-4 whitespace-nowrap">
        <span class="px-2 py-1 text-xs font-semibold rounded-none
            @if($course->status === 'upcoming') bg-blue-100 text-blue-800
            @elseif($course->status === 'active') bg-green-100 text-green-800
            @elseif($course->status === 'completed') bg-gray-100 text-gray-800
            @else bg-red-100 text-red-800
            @endif">
            {{ ucfirst($course->status) }}
        </span>
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
        <a href="{{ route('admin.courses.show', $course) }}" class="text-brand-primary hover:text-blue-900">View</a>
        <a href="{{ route('admin.courses.edit', $course) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
        <form method="POST" action="{{ route('admin.courses.destroy', $course) }}" class="inline" 
              onsubmit="return confirm('Are you sure?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
        </form>
    </td>
</tr>
